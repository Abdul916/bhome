/*
http://www.dustindiaz.com/javascript-observer-class/

* Publishers are in charge of "publishing" eg: Creating the Event
* They're also in charge of "notifying" (firing the event)

var o = new Observer;
o.fire('here is my data');


* Subscribers basically... "subscribe" (or listen)
* And once they've been "notified" their callback functions are invoked

var fn = function() {
// my callback stuff
};
o.subscribe(fn);


* Don't want to subscribe anymore?

o.unsubscribe(fn);
*/
//http://www.tutorialspoint.com/javascript/array_filter.htm
if (!Array.prototype.filter)
{
  Array.prototype.filter = function(fun /*, thisp*/)
  {
    var len = this.length;
    if (typeof fun != "function")
      throw new TypeError();

    var res = new Array();
    var thisp = arguments[1];
    for (var i = 0; i < len; i++)
    {
      if (i in this)
      {
        var val = this[i]; // in case fun mutates this
        if (fun.call(thisp, val, i, this))
          res.push(val);
      }
    }
    return res;
  };
}
//http://www.tutorialspoint.com/javascript/array_foreach.htm
if (!Array.prototype.forEach)
{
  Array.prototype.forEach = function(fun /*, thisp*/)
  {
    var len = this.length;
    if (typeof fun != "function")
      throw new TypeError();

    var thisp = arguments[1];
    for (var i = 0; i < len; i++)
    {
      if (i in this)
        fun.call(thisp, this[i], i, this);
    }
  };
}

function Observer() {
    this.fns = [];
}
Observer.prototype = {
    subscribe : function(fn) {
        this.fns.push(fn);
    },
    unsubscribe : function(fn) {
        this.fns = this.fns.filter(
            function(el) {
                if ( el !== fn ) {
                    return el;
                }
            }
        );
    },
    fire : function(o, thisObj) {
        var scope = thisObj || window;
        this.fns.forEach(
            function(el) {
                el.call(scope, o);
            }
        );
    }
};

var o = new Observer;