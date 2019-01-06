// constructor
function Animator(maxStep) {
	this._initialize(maxStep);
}
Animator.prototype.setTickerTape = function(tickerTape) {
	this.tickerTape = tickerTape;
}
// start animation
Animator.prototype.doStart = function() {
}
// stop animation
Animator.prototype.doPause = function() {
}
// animation step called by tickerTape - do not touch
Animator.prototype.doStep = function() {
		var element = this.tickerTape.getCurrentChild();
		
		if(element){
			this._animate(element);
		}
		
		this.step++;
}
//
Animator.prototype.doReset = function() {
	this.running = false;
	this.step = 0;
	this._reset();
}

Animator.prototype._reset = function() {
}

Animator.prototype.isFinished = function() {
	return (this.step>=this.maxStep);
}
// Computes the height including top and bottom margins of an element
Animator.prototype.getElementHeight = function(element) {

	var height = element.offsetHeight;
	var topMargin = 0;
	var bottomMargin = 0;

	if (element.currentStyle) {
		topMargin		= element.currentStyle['marginTop'];
		bottomMargin	= element.currentStyle['marginBottom'];
	} else if (window.getComputedStyle) {
		topMargin = document.defaultView.getComputedStyle(element,null).getPropertyValue('margin-top');
		bottomMargin = document.defaultView.getComputedStyle(element,null).getPropertyValue('margin-bottom');
	}
	
	var isSafari = false;
	
	if(navigator.vendor && navigator.vendor.indexOf('Apple') > -1) {
		isSafari = true;
	}
	
	if(!isSafari) {
		topMargin = topMargin.replace('px', '');
		bottomMargin = bottomMargin.replace('px', '');
	}

	if(topMargin == 'auto') topMargin = 0;
	if(bottomMargin == 'auto') bottomMargin = 0;

	return parseFloat(height) + parseFloat(topMargin) + parseFloat(bottomMargin);
}


// Computes the height including top and bottom margins of an element
Animator.prototype.getElementWidth = function(element) {

	var height = element.offsetWidth;
	var leftMargin = 0;
	var rightMargin = 0;

	if (element.currentStyle) {
		leftMargin	= element.currentStyle['marginLeft'];
		rightMargin	= element.currentStyle['marginRight'];
	} else if (window.getComputedStyle) {
		leftMargin = document.defaultView.getComputedStyle(element,null).getPropertyValue('margin-left');
		rightMargin = document.defaultView.getComputedStyle(element,null).getPropertyValue('margin-right');
	}
	
	var isSafari = false;
	
	if(navigator.vendor && navigator.vendor.indexOf('Apple') > -1) {
		isSafari = true;
	}
	
	if(!isSafari) {
		leftMargin = leftMargin.replace('px', '');
		rightMargin = rightMargin.replace('px', '');
	}

	if(leftMargin == 'auto') leftMargin = 0;
	if(rightMargin == 'auto') rightMargin = 0;

	return parseFloat(height) + parseFloat(leftMargin) + parseFloat(rightMargin);
}

// animation step implementation
Animator.prototype._animate = function(element) {
}

Animator.prototype._initialize = function(maxStep) {
	this.tickerTape = null;
	this.running = false;
	this.step = 0;
	this.maxStep = maxStep;
}


// fixed speed scroller
ScrollingAnimator.prototype = new Animator;
ScrollingAnimator.prototype.constructor = ScrollingAnimator;
function ScrollingAnimator(maxStep) {
	this._initialize(maxStep);
}
ScrollingAnimator.prototype._animate = function(element) {
	var width = this.getElementWidth(element);
	var stp = width / this.maxStep;
	var pos  = this.tickerTape.container.style.left.replace('px', '');
	if(pos == '')
	{
		pos = 0;
	}
	pos = parseFloat(pos) - stp;
	this.tickerTape.container.style.left = pos + 'px';
}

// smooth scroller
SmoothScrollingAnimator.prototype = new Animator;
SmoothScrollingAnimator.prototype.constructor = SmoothScrollingAnimator;
function SmoothScrollingAnimator(maxStep) {
	this._initialize(maxStep);
	this.toScroll = -1;
}
SmoothScrollingAnimator.prototype._animate = function(element) {
	var width = this.getElementWidth(element);
	
	if(this.toScroll == -1) {
		this.toScroll = width;
	}

	var stp = parseInt(this.toScroll / 2.0);

	var pos  = this.tickerTape.container.style.left.replace('px', '');
	if(pos == '') {
		pos = 0;
	}

	if(this.toScroll <= 1.5 && this.toScroll>0) {
		stp = this.toScroll;
	}

	pos = parseFloat(pos) - stp;
	this.toScroll -= stp;
	
	this.tickerTape.container.style.left = pos + 'px';
}
SmoothScrollingAnimator.prototype._reset = function() {
	this.toScroll = -1;
}

// fadein
FadeinAnimator.prototype = new Animator;
FadeinAnimator.prototype.constructor = FadeinAnimator;
function FadeinAnimator(maxStep, fade) {
	this._initialize(maxStep);
	this.positioned = false;
	this.fade = fade;
	
	this.colorIndex = 255;
}
FadeinAnimator.prototype._animate = function(element) {
	
	if(!this.positioned) {
		this.positioned = true;
		var width = this.getElementWidth(element);
		var pos  = this.tickerTape.container.style.left.replace('px', '');
		if(pos == '') {
			pos = 0;
		}
		pos = parseFloat(pos) - width;
		this.tickerTape.container.style.left = pos + 'px';
	}
	
	if(this.fade) {
		this.colorIndex -= 8;
		if(this.colorIndex<0) {
			this.colorIndex = 0;
		}

		var myElement = this.tickerTape.getNextChild();
		if(myElement) {
			this._fade(myElement, this.colorIndex);
		}
	}
}
FadeinAnimator.prototype._reset = function() {
	this.positioned = false;
	this.colorIndex = 255;
}
FadeinAnimator.prototype._fade = function(element, clr) {
	var strong = element.getElementsByTagName('strong')[0];
	if(strong) {
		strong.style.color="rgb("+clr+","+clr+","+clr+")";
	}
	var ancor = element.getElementsByTagName('a')[0];
	if(ancor) {
		ancor.style.color="rgb("+clr+","+clr+",210)";
	}
}

