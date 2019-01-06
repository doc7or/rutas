//
// Copyright (c) 2007 Postecom
//
// based on script by Colin Ramsay
// 
//
//



function TickerTape(elementId, url, cssClassName, scrollInterval, animator) {
	this.childUpdateThreshold = 9999;

	animator.setTickerTape(this);
	this.animator = animator;

	// Request JSON data from this url.
	this.dataUrl = url;

	// The classname which will be assigned to the tickertape container
	// Note: this is assigned in addition to 'basicTickerTape'.
	this.cssClassName = cssClassName;

	// intervallo minimo in millisecondi tra due richieste al server
	this.scrollInterval = scrollInterval;

	this.currentStep = 0;

	// Used to track the window.setInterval id for the scroll
	// so that we only have one scroll going at once.
	this.scrollIntervalId = null;

	// The number of items returned in the last update.
	this.numberReturned = 0;

	// Tracks the item within the container which was just scrolled.
	this.currentChild = 0;

	this.isScrollPaused = false;
	
	this.scrolling = false;
	
	this.lastRequestTime = new Date();

	// Start it up!
	this.init(elementId);
};


// Creates a <div> element at the point where the TickerTape script
// was included. The <div> has a class of tickerTape and a random id.
TickerTape.prototype.createDom = function(elementId) {

	var tickerTapeWrapper = document.getElementById(elementId);
	tickerTapeWrapper.className = this.cssClassName + " basicTickerTape";
	var ul = document.createElement("ul");
	tickerTapeWrapper.appendChild(ul);

	xb.addEvent(tickerTapeWrapper, 'mouseenter', this.pauseScroll.simpleBind(this));
	xb.addEvent(tickerTapeWrapper, 'mouseleave', this.resumeScroll.simpleBind(this));

	// Assign the new <div> element to a property of the tickertape class for easy access
	this.container = tickerTapeWrapper.getElementsByTagName('ul')[0];
}


// Calls the server with lastId we received to get the next lot of items back. Note
// that this.lastId will be 0 if this is the first time the update has been called
TickerTape.prototype.update = function() {
	// We need to be able to handle a dataUrl with existing querystring parameters
	var concatCharacter = this.dataUrl.indexOf('?') > -1 ? '&' : '?';
	var urlWithParams = this.dataUrl + concatCharacter + "lastId=0";

	var xhr = false;
	try
	{
		xhr = new XMLHttpRequest();
	}
	catch(e1)
	{
		try
		{
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch(e2) 
		{
			try
			{
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e3)
			{
				xhr = false;
			}
		}
	}
	
	if(xhr)
	{
	
		// Set up a callback function
		xhr.onreadystatechange = this.updateCallback.simpleBind(this, xhr);
	
		try
		{
			// Make the request
			xhr.open("GET", urlWithParams);
			xhr.send("");
		}
		catch(e1)
		{
		}
	}
}
TickerTape.prototype.addItem = function(t, u, l) {
	var listItem = document.createElement('li');

	var title = document.createElement('i');
	title.innerHTML = t;

	var anchor = document.createElement('a');
	anchor.href = "javascript:openNew('"+u+"','anew','width=640,height=400');";
	anchor.innerHTML = l;
	
	var emptySpan = document.createElement('span');
	emptySpan.innerHTML = " &nbsp;&nbsp;&nbsp;"

	listItem.appendChild(title);
	listItem.appendChild(anchor);
	listItem.appendChild(emptySpan);

	// Add the built item to the document
	this.container.appendChild(listItem);
}

TickerTape.prototype.addEmptyItem = function() {
	var listItem = document.createElement('li');
	listItem.className = 'emptyItem';

	var span = document.createElement('span');
	span.innerHTML = "&nbsp;";
	listItem.appendChild(span);

	// Add the built item to the document
	this.container.appendChild(listItem);
}

// The server should return an array of objects that we can use
// to form an item on the tape.
TickerTape.prototype.updateCallback = function(e) {

	// Only run this if the XHR has finished loading
	if (e.readyState != 4) {
		return;
	}

	// Probably should swap this call to eval for something safer?
	var json = eval(e.responseText);

	// Remember the number returned in this request so we can use it elsewhere
	this.numberReturned = json.length;
	this.childUpdateThreshold = this.numberReturned + 1;

	this.addEmptyItem();

	// Now loop through all the returned items and build HTML from them
	for(var i = 0; i < this.numberReturned; i++) {

		// Produces HTML like this:
		// <li><p>Title</p><p class="tickerLink"><a href="Url">LinkText</a></p>
		this.addItem(json[i].Title, json[i].Url, json[i].LinkText);
	}
	
	var ancor = document.getElementById("news24link");
	if(ancor) {
		if(this.numberReturned==0) {
			ancor.style.visibility="hidden";
		}
		else {
			ancor.style.visibility="visible";
		}
	}
	
	this.addEmptyItem();
	this.addEmptyItem();
	
	this.scroll();
};

TickerTape.prototype.getCurrentChild = function() {
	var element = this.container.childNodes[this.currentChild];
	return element;
}

TickerTape.prototype.getPreviousChild = function() {
	var indx = this.currentChild-1;
	if(indx>=0) {
		var element = this.container.childNodes[indx];
		return element;
	}
	return null;
}

TickerTape.prototype.getNextChild = function() {
	var indx = this.currentChild+1;
	var element = this.container.childNodes[indx];
	return element;
}

TickerTape.prototype.scroll = function() {
	if(!this.scrollIntervalId) {
		var animator = this.animator;
		var tickerTape = this;

		// Begin the scroll
		this.scrollIntervalId = window.setInterval(function() {
			if(!tickerTape.isScrollPaused && !tickerTape.scrolling) {
				tickerTape.scrolling = true;
				animator.doStep();

				if(animator.isFinished())
				{
					tickerTape.currentChild++;
					animator.doReset();
				}

				tickerTape.updateIfNecessary();
				tickerTape.scrolling = false;
			}
		}, 50);
	}

}

// Only calls update if the currentChild has passed the update threshold.
TickerTape.prototype.updateIfNecessary = function() {
	var now = new Date();
	var elapsed = now.getTime() - this.lastRequestTime.getTime();

	if((elapsed > this.scrollInterval) && (this.currentChild > this.childUpdateThreshold)) {
		window.clearInterval(this.scrollIntervalId);
		this.scrollIntervalId = null;

		while (this.container.hasChildNodes())
		{
			this.container.removeChild(this.container.firstChild);
		}

		this.childUpdateThreshold = 9999;

		this.currentChild = 0;
		this.container.style.left = "0px";

		this.update();
		this.lastRequestTime = new Date();
	}
}


// chiamato al termine dell'instanziazione del TickerTape
TickerTape.prototype.init = function(elementId) {
	// crea gli oggetti
	this.createDom(elementId);
	
	// imposta il callback temporizzato per il primo scroll
	// la prima visualizzazione viene attivata dopo un certo intervallo di tempo definito
	// nella costruzione dell'oggetto
	var timeoutCallback = this.updateFirst.simpleBind(this);
	this.scrollIntervalId = window.setInterval(function() { timeoutCallback(); }, this.scrollInterval);
}

// primo update: rimuove il timer (usato solo la prima volta) e attiva
// l'effettivo update
TickerTape.prototype.updateFirst = function() {
	window.clearInterval(this.scrollIntervalId);
	this.scrollIntervalId = null;
	this.update();
}

// mette in pausa gli effetti
TickerTape.prototype.pauseScroll = function() {
	this.isScrollPaused = true;
}


// prosegue gli effetti
TickerTape.prototype.resumeScroll = function() {
	this.isScrollPaused = false;
}



// Simple version of the Prototype library's bind() which will only work in
// this case, but doing it this way removes the need for Prototype's $A support.
Function.prototype.simpleBind = function() {

	var	__method = this;
	var args =	[arguments[1]];
	var object =	arguments[0];

	return function() {
		return __method.apply(object, args);
	}
}


var xb =
{
	evtHash: [],

	ieGetUniqueID: function(_elem)
	{
		if (_elem === window) { return 'theWindow'; }
		else if (_elem === document) { return 'theDocument'; }
		else { return _elem.uniqueID; }
	},

	addEvent: function(_elem, _evtName, _fn, _useCapture)
	{
		if (typeof _elem.addEventListener != 'undefined')
		{
			if (_evtName == 'mouseenter')
				{ _elem.addEventListener('mouseover', xb.mouseEnter(_fn), _useCapture); }
			else if (_evtName == 'mouseleave')
				{ _elem.addEventListener('mouseout', xb.mouseEnter(_fn), _useCapture); } 
			else
				{ _elem.addEventListener(_evtName, _fn, _useCapture); }
		}
		else if (typeof _elem.attachEvent != 'undefined')
		{
			var key = '{FNKEY::obj_' + xb.ieGetUniqueID(_elem) + '::evt_' + _evtName + '::fn_' + _fn + '}';
			var f = xb.evtHash[key];
			if (typeof f != 'undefined')
				{ return; }
			
			f = function()
			{
				_fn.call(_elem);
			};
		
			xb.evtHash[key] = f;
			_elem.attachEvent('on' + _evtName, f);
	
			// attach unload event to the window to clean up possibly IE memory leaks
			window.attachEvent('onunload', function()
			{
				_elem.detachEvent('on' + _evtName, f);
			});
		
			key = null;
			//f = null;   /* DON'T null this out, or we won't be able to detach it */
		}
		else
			{ _elem['on' + _evtName] = _fn; }
	},	

	removeEvent: function(_elem, _evtName, _fn, _useCapture)
	{
		if (typeof _elem.removeEventListener != 'undefined')
			{ _elem.removeEventListener(_evtName, _fn, _useCapture); }
		else if (typeof _elem.detachEvent != 'undefined')
		{
			var key = '{FNKEY::obj_' + xb.ieGetUniqueID(_elem) + '::evt' + _evtName + '::fn_' + _fn + '}';
			var f = xb.evtHash[key];
			if (typeof f != 'undefined')
			{
				_elem.detachEvent('on' + _evtName, f);
				delete xb.evtHash[key];
			}
		
			key = null;
			//f = null;   /* DON'T null this out, or we won't be able to detach it */
		}
	},
	
	mouseEnter: function(_pFn)
	{
		return function(_evt)
		{
			var relTarget = _evt.relatedTarget;				
			if (this == relTarget || xb.isAChildOf(this, relTarget))
				{ return; }

			_pFn.call(this, _evt);
		}
	},
	
	isAChildOf: function(_parent, _child)
	{
		if (_parent == _child) { return false };
		
		while (_child && _child != _parent)
			{ _child = _child.parentNode; }
		
		return _child == _parent;
	}	
};


function openNew(url, name, size)
{
	window.open(url, name, size+",resizable=no,menubar=no,toolbar=no,location=no,status=no,scrollbars=yes");
}