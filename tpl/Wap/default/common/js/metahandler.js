var MetaHandler = {
  ready: false,
  meta: {},
  /**
   * 初始化
   * _els
   * meta = {name:{content:String,seriation:Array,store:{property:String},...},...}
   * ready = true
   * @method init
   */
  init: function () {
    this._els = document.getElementsByTagName('meta');
    for (var i = 0; i < this._els.length; i++) {
      var name = this._els[i].name;
      if (name) {
        name = name.replace('-', '_');
        this.meta[name] = {};
        this.meta[name].el = this._els[i];
        this.meta[name].content = this._els[i].content;
        this.meta[name].seriation = this.meta[name].content.split(',');
        this.meta[name].store = this.getContentStore(name);
      }
    }
    this.ready = true;
    return this;
  },
  getContentStore: function (name) {
    name = name.replace('-', '_');
    var content = this.meta[name].seriation, store = {};
    for (var i = 0; i < content.length; i++) {
      if (content[i].length < 1) {
        content[i] = null;
        delete content[i];
        content.length--;
      } else {
        var ct = content[i].split('='),
          pp = ct[0].replace('-', '_');
        if (pp) {
          store[pp] = ct[1];
        }
      }
    }
    return store;
  },
  setContent: function (name, value) {
    !this.ready && this.init();
    name = name.replace('-', '_');
    this.meta[name].content = value;
    this.meta[name].el.content = value;
    return this;
  },
  getContent: function (name) {
    !this.ready && this.init();
    name = name.replace('-', '_');
    return this.meta[name] && this.meta[name].content;
  },
  updateContent: function (name) {
    !this.ready && this.init();
    this.meta[name].content = this.meta[name].seriation.join(',');
    this.setContent(name, this.meta[name].content);
    return this;
  },
  removeContentProperty: function (name, property) {
    !this.ready && this.init();
    var name = name.replace('-', '_'),
      _property = property.replace('-', '_');
    if (this.meta[name]) {
      if (this.meta[name].store[_property] != null) {
        for (var i = 0; i < this.meta[name].seriation.length; i++) {
          if (this.meta[name].seriation[i].indexOf(property + '=') != -1) {
            this.meta[name].seriation[i] = null;
            delete this.meta[name].seriation[i];
            break;
          }
        }
      }
      this.updateContent(name);
    }
    return this;
  },
  getContentProperty: function (name, property) {
    !this.ready && this.init();
    name = name.replace('-', '_');
    property = property.replace('-', '_');
    return this.meta[name] && this.meta[name].store[property];
  },
  setContentProperty: function (name, property, value) {
    !this.ready && this.init();
    var name = name.replace('-', '_'),
      _property = property.replace('-', '_'),
      pv = property + '=' + value;
    if (this.meta[name]) {
      if (this.meta[name].store[_property] != null) {
        this.meta[name].store[_property] = value;
        for (var i = 0; i < this.meta[name].seriation.length; i++) {
          if (this.meta[name].seriation[i].indexOf(property + '=') != -1) {
            this.meta[name].seriation[i] = pv;
            break;
          }
        }
      } else {
        this.meta[name].store[_property] = value;
        this.meta[name].seriation.push(pv);
      }
      this.updateContent(name);
    }
    return this;
  },
  fixViewportWidth: function (width) {
    !this.ready && this.init();
    width = width || this.getContentProperty('viewport', 'width');
    if (width != 'device-width') {
      var iw = window.innerWidth || width,
        ow = window.outerWidth || iw,
        sw = window.screen.width || iw,
        saw = window.screen.availWidth || iw,
        ih = window.innerHeight || width,
        oh = window.outerHeight || ih,
        ish = window.screen.height || ih,
        sah = window.screen.availHeight || ih,
        w = Math.min(iw, ow, sw, saw, ih, oh, ish, sah),
        ratio = w / width,
        dpr = window.devicePixelRatio,
        ratio = Math.min(ratio, dpr);
      window.fixWidth = Math.min(iw, ow, sw, saw);
      window.fixHeight = Math.min(ih, oh, ish, sah);
      this.removeContentProperty('viewport', 'user-scalable');
      if (ratio < 1) {
        this.setContentProperty('viewport', 'initial-scale', ratio);
        //this.setContentProperty('viewport','minimum-scale',ratio);
        this.setContentProperty('viewport', 'maximum-scale', ratio);
      }
      this.setContentProperty('viewport', 'user-scalable', 'no');
    }
  }
}

MetaHandler.fixViewportWidth(640);
