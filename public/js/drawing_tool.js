/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ 5:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(6);


/***/ }),

/***/ 6:
/***/ (function(module, exports) {

window.onload = function () {

    // let ctx = canvas.getContext('2d');
    // ctx.fillStyle = 'green';
    // ctx.fillRect(10, 10, 100, 100);
    // ctx.drawImage(map, 0, 0);

    DrawingSet = new Object();
    // Register element
    DrawingSet.map = document.getElementById('map');
    DrawingSet.canvas = document.getElementById('canvas');
    DrawingSet.textInput = document.getElementById('text');
    DrawingSet.undoButton = document.getElementById('undo');
    DrawingSet.redoButton = document.getElementById('redo');
    DrawingSet.textBlack = document.getElementById('text-black');
    DrawingSet.textWhite = document.getElementById('text-white');
    DrawingSet.poligonTool = document.getElementById('poligon-tool');
    DrawingSet.zoomTool = document.getElementById('zoom-tool');
    DrawingSet.dragTool = document.getElementById('drag-tool');
    // Canvas context
    DrawingSet.ctx = this.canvas.getContext('2d');
    // Tool status
    DrawingSet.activeTool = null;
    // Data initialize
    DrawingSet.data = new Object();
    // Zoom
    DrawingSet.data.scale = 1;
    DrawingSet.data.offset = { x: 0, y: 0 };
    // Geometry
    DrawingSet.data.geometry = { points: [], color: 'green', completed: 0 };
    DrawingSet.helper = { activated: 0, x: 0, y: 0
        // Text
    };DrawingSet.data.text = { text: null, color: 'black', size: '100px', x: 100, y: 100 };
    // History
    DrawingSet.history = [];
    // Future
    DrawingSet.future = [];
    // Methods
    DrawingSet.render = function (type) {
        switch (type) {
            case 'undo':
                if (this.history[0].geometry.completed == 1) {
                    this.history.shift();
                    this.history.shift();
                }
                if (this.history.length > 1) this.future.unshift(this.history.shift());
                this.textInput.value = this.history[0].text.text;
                this.data = this.history[0];
                break;
            case 'redo':
                if (this.future.length > 0) this.history.unshift(this.future.shift());
                this.textInput.value = this.history[0].text.text;
                this.data = this.history[0];
                break;
            case 'helper':
                // case 'zoom':
                break;
            default:
                this.future = [];
                this.history.unshift(JSON.parse(JSON.stringify(this.data)));

        }
        // console.log(this.history[0].geometry.points);
        if (this.history[1]) this.ctx.scale(1 / this.history[1].scale, 1 / this.history[1].scale);
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.ctx.scale(this.history[0].scale, this.history[0].scale);
        if (this.history[0].text.text) {
            this.ctx.beginPath();
            this.ctx.font = this.history[0].text.size + ' Georgia';
            this.ctx.fillStyle = this.history[0].text.color;
            this.ctx.fillText(this.history[0].text.text, this.history[0].text.x, this.history[0].text.y);
            this.ctx.fill();
        }
        if (this.history[0].geometry.points.length) {
            // console.log(this.history[0].geometry.points);
            this.ctx.beginPath();
            this.ctx.fillStyle = this.history[0].geometry.color;
            this.ctx.strokeStyle = this.history[0].geometry.color;
            var points = this.history[0].geometry.points;
            for (var x in points) {
                if (x == 0) this.ctx.moveTo(points[x].x, points[x].y);else this.ctx.lineTo(points[x].x, points[x].y);
            }
            if (type != 'undo' && type != 'redo') {
                this.ctx.lineTo(this.helper.x, this.helper.y);
                if (points.length > 1) this.ctx.fill();else this.ctx.stroke();
            } else {
                if (points.length > 2) this.ctx.fill();else this.ctx.stroke();
            }
        }
    };
    DrawingSet.textChange = function (text) {
        this.data.text.text = text;
        this.render();
    };
    DrawingSet.textColorChange = function (color) {
        this.data.text.color = color;
        this.render();
    };
    DrawingSet.undo = function () {
        this.render('undo');
    };
    DrawingSet.redo = function () {
        this.render('redo');
    };
    // Poligon tool
    DrawingSet.createPoint = function (x, y) {
        if (!this.helper.activated) {
            this.helper.activated = 1;
            this.helper.x = x / this.history[0].scale;
            this.helper.y = y / this.history[0].scale;
            this.data.geometry.points = [];
        }
        this.data.geometry.points.push({ x: x / this.history[0].scale, y: y / this.history[0].scale });
        this.render('create-point');
    };
    DrawingSet.showLine = function (x, y) {
        if (this.helper.activated) {
            this.helper.x = x / this.history[0].scale;
            this.helper.y = y / this.history[0].scale;
            this.render('helper');
        }
    };
    DrawingSet.completeDrawing = function () {
        this.helper.activated = 0;
        this.data.geometry.completed = 1;
        this.render();
    };
    DrawingSet.geometryColorChange = function (color) {
        this.data.geometry.color = color;
        this.render();
    };
    // Zoom tool
    DrawingSet.zoom = function () {
        this.data.scale = this.data.scale == 1 ? 2 : 1;
        this.canvas.style.cursor = this.data.scale == 1 ? 'zoom-in' : 'zoom-out';
        this.render('zoom');
    };

    // Toggle tool
    DrawingSet.togglePoligon = function () {
        this.activeTool = this.activeTool == 'poligon' ? null : 'poligon';
        this.canvas.style.cursor = this.activeTool == 'poligon' ? 'crosshair' : 'default';
    };
    DrawingSet.toggleZoom = function () {
        this.activeTool = this.activeTool == 'zoom' ? null : 'zoom';
        this.canvas.style.cursor = this.activeTool == 'zoom' ? 'zoom-in' : 'default';
    };
    DrawingSet.toggleDrag = function () {
        this.activeTool = this.activeTool == 'drag' ? null : 'drag';
        this.canvas.style.cursor = this.activeTool == 'drag' ? '-webkit-grab' : 'default';
    };

    // Register function
    DrawingSet.textInput.onkeyup = function () {
        DrawingSet.textChange(this.value);
    };
    DrawingSet.undoButton.onclick = function () {
        DrawingSet.undo();
    };
    DrawingSet.redoButton.onclick = function () {
        DrawingSet.redo();
    };
    DrawingSet.textBlack.onclick = function () {
        DrawingSet.textColorChange('black');
    };
    DrawingSet.textWhite.onclick = function () {
        DrawingSet.textColorChange('white');
    };
    DrawingSet.canvas.onmousedown = function () {
        switch (DrawingSet.activeTool) {
            case 'drag':
                DrawingSet.canvas.style.cursor = '-webkit-grabbing';
                DrawingSet.drag = true;
                break;
        }
    };
    DrawingSet.canvas.onmouseup = function () {
        switch (DrawingSet.activeTool) {
            case 'drag':
                DrawingSet.canvas.style.cursor = '-webkit-grab';
                DrawingSet.drag = false;
                break;
        }
    };
    DrawingSet.canvas.onmousemove = function (event) {
        switch (DrawingSet.activeTool) {
            case 'poligon':
                DrawingSet.showLine(event.offsetX, event.offsetY);
                break;
        }
    };
    DrawingSet.canvas.onclick = function (event) {
        switch (DrawingSet.activeTool) {
            case 'poligon':
                DrawingSet.createPoint(event.offsetX, event.offsetY);
                break;
            case 'zoom':
                DrawingSet.zoom();
                break;
        }
    };
    DrawingSet.canvas.ondblclick = function () {
        switch (DrawingSet.activeTool) {
            case 'poligon':
                DrawingSet.completeDrawing();
                break;
        }
    };
    DrawingSet.poligonTool.onclick = function () {
        DrawingSet.togglePoligon();
    };
    DrawingSet.zoomTool.onclick = function () {
        DrawingSet.toggleZoom();
    };
    DrawingSet.dragTool.onclick = function () {
        DrawingSet.toggleDrag();
    };
    // Start display
    DrawingSet.render();
};

/***/ })

/******/ });