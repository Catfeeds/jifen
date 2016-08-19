<?php
final class payHandle
{
    public $from;
    public $db;
    public $payType;
    public $token;
    public function __construct($token, $from, $paytype = 'tenpay')
    {
        $this->from = $from;
        $this->from = $from ? $from : 'Groupon';
        $this->from = $this->from != 'groupon' ? $this->from : 'Groupon';
        switch (strtolower($this->from)) {
            default:
            case 'groupon':
            case 'store':
                $this->db = M('Product_cart');
                break;
            case 'repast':
                $this->db = M('Dish_order');
                break;
            case 'hotels':
                $this->db = M('Hotels_order');
                break;
            case 'business':
                $this->db = M('Reservebook');
                break;
            case 'card':
                $this->db = M('Member_card_pay_record');
                break;
            case 'distribution':
                $this->db = M('level_orders');
                break;
        }
        $this->token = $token;
        $this->payType = $paytype;
    }
    public function getFrom()
    {
        return $this->from;
    }
    public function beforePay($id)
    {
        $thisOrder = $this->db->where(array('token' => $this->token, 'orderid' => $id))->find();
        switch (strtolower($this->from)) {
            default:
                $price = $thisOrder['price'];
                break;
            case 'business':
                $price = $thisOrder['payprice'];
                break;
        }
        return array('orderid' => $thisOrder['orderid'], 'price' => $price, 'wecha_id' => $thisOrder['wecha_id'], 'token' => $thisOrder['token']);
    }
    public function afterPay($id, $transaction_id = '')
    {
        $thisOrder = $this->beforePay($id);
        $wecha_id = $thisOrder['wecha_id'];
        $order_model = $this->db;
        $order_model->where(array('orderid' => $id))->setField('paid', 1);
        if (strtolower($this->getFrom()) == 'groupon') {
            $order_model->where(array('orderid' => $thisOrder['orderid']))->save(array('transactionid' => $transaction_id, 'paytype' => $this->payType));
        }
        $orderData = $order_model->where(array('orderid'=>$id))->find();
        $member = M('Distribution_member')->where(array('wecha_id'=>$orderData['wecha_id']))->find();
        $account = M('Distribution_account')->where(array('id'=>$orderData['aid']))->find();
        if (strtolower($this->getFrom()) == 'distribution') {
            if($orderData['handled'] == 0){
                $set = M('Distribution_set')->find();
                //自己充值绿色积分
                $this->earnRecord($account['id'],$orderData['id'],$orderData['green'],0,0,6,$member['id']);
                //返还上级积分
                if($account['bindaid']){
                    $this->earnRecord($account['bindaid'],$orderData['id'],0,$orderData['integral'] * $set['firstPer']/100,0,1,$member['id']);
                    //返还上上级积分
                    $upupaid = D('Account')->where('id='.$account['bindaid'])->getField('bindaid');
                    if($upupaid){
                        $this->earnRecord($upupaid,$orderData['id'],0,$orderData['integral'] * $set['secondPer']/100,0,2,$member['id']);
                    }
                }
                //返还代理点积分
                if($account['agent']){
                    $this->earnRecord($account['agent'],$orderData['id'],0,$orderData['integral'] * $set['thirdPer']/100,0,3,$member['id']);
                }
                //返还公司积分
                $this->earnRecord(-1,$orderData['id'],0,$orderData['integral'] * $set['comPer']/100,0,4,$member['id']);

                $order_model->where(array('orderid'=>$id))->setField('handled',1);
            }
        }
        return $thisOrder;
    }
    //金币和现金收入支出记录
    public function earnRecord($aid,$oid,$green,$red,$black,$status,$mid){
        if($aid > 0){
            if($green != 0){
                D('Account')->where('id='.$aid)->setInc('green',$green);
            }
            if($red != 0){
                D('Account')->where('id='.$aid)->setInc('red',$red);
            }
            if($black != 0){
                D('Account')->where('id='.$aid)->setInc('black',$black);
            }
        }
        $earndb = M('Distribution_earning');
        $data = array(
            'aid' => $aid,
            'oid' => $oid,
            'mid' => $mid,
            'green' => $green,
            'red' => $red,
            'black' => $black,
            'status' => $status,
            'addtime' => time(),
            'year' => date('Y',time()),
            'month' => date('m',time()),
            'day' => date('d',time()),
        );
        $earndb->add($data);
    }
}