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
    DrawingSet.scale = [1, 1];
    DrawingSet.data.offset = { x: 0, y: 0 };
    // Geometry
    DrawingSet.data.geometry = { points: [], color: 'green', completed: 0 };
    DrawingSet.data.helper = { activated: 0, x: 0, y: 0
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
                if (this.history.length > 1) this.future.unshift(this.history.shift());
                this.textInput.value = this.history[0].text.text;
                this.data = JSON.parse(JSON.stringify(this.history[0]));
                break;
            case 'redo':
                if (this.future.length > 0) this.history.unshift(this.future.shift());
                this.textInput.value = this.history[0].text.text;
                this.data = JSON.parse(JSON.stringify(this.history[0]));
                break;
            case 'helper':
            case 'drag':
            case 'zoom':
                break;
            default:
                this.future = [];
                if (this.data.geometry.completed == 1) {
                    this.history.shift();
                    this.history.shift();
                }
                this.history.unshift(JSON.parse(JSON.stringify(this.data)));

        }
        // if(type != 'zoom')this.scale = [1, 1];
        // console.log(this.history[0].geometry.points);
        if (type == 'zoom') this.ctx.scale(1 / this.scale[1], 1 / this.scale[1]);
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        if (type == 'zoom') this.ctx.scale(this.scale[0], this.scale[0]);

        // map
        this.ctx.drawImage(this.map, 0, 0, this.canvas.width, this.canvas.height);

        // text displaying
        if (this.history[0].text.text) {
            this.ctx.beginPath();
            this.ctx.font = this.history[0].text.size + ' Georgia';
            this.ctx.fillStyle = this.history[0].text.color;
            this.ctx.fillText(this.history[0].text.text, this.history[0].text.x, this.history[0].text.y);
            this.ctx.fill();
        }
        // drawing displaying
        if (this.history[0].geometry.points.length) {
            // console.log(this.history[0].geometry.points);
            this.ctx.beginPath();
            this.ctx.globalAlpha = 0.5;
            this.ctx.fillStyle = this.history[0].geometry.color;
            this.ctx.strokeStyle = this.history[0].geometry.color;
            var points = this.history[0].geometry.points;
            for (var x in points) {
                if (x == 0) this.ctx.moveTo(points[x].x, points[x].y);else this.ctx.lineTo(points[x].x, points[x].y);
            }
            if (type != 'undo' && type != 'redo') {
                this.ctx.lineTo(this.data.helper.x, this.data.helper.y);
                if (points.length > 1) this.ctx.fill();else this.ctx.stroke();
            } else {
                if (points.length > 2) this.ctx.fill();else this.ctx.stroke();
            }
            this.ctx.globalAlpha = 1;
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
        if (!this.data.geometry.completed) {
            if (!this.data.helper.activated) {
                this.data.helper.activated = 1;
                this.data.helper.x = x / this.scale[0];
                this.data.helper.y = y / this.scale[0];
                this.data.geometry.points = [];
            }
            this.data.geometry.points.push({ x: x / this.scale[0], y: y / this.scale[0] });
            this.render('create-point');
        }
    };
    DrawingSet.showLine = function (x, y) {
        if (this.data.helper.activated) {
            this.data.helper.x = x / this.scale[0];
            this.data.helper.y = y / this.scale[0];
            this.render('helper');
        }
    };
    DrawingSet.completeDrawing = function () {
        this.data.helper.activated = 0;
        this.data.geometry.completed = 1;
        this.render();
    };
    DrawingSet.geometryColorChange = function (color) {
        this.data.geometry.color = color;
        this.render();
    };
    // Zoom tool
    DrawingSet.zoom = function () {
        this.scale[0] = this.scale[0] == 1 ? 2 : 1;
        this.scale[1] = this.scale[0] == 1 ? 2 : 1;
        // console.log(this.scale);
        this.canvas.style.cursor = this.scale[0] == 1 ? 'zoom-in' : 'zoom-out';
        this.render('zoom');
    };
    DrawingSet.drag = function () {
        this.render('drag');
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
    DrawingSet.clear = function () {
        this.data.geometry.points = [];
        this.data.geometry.completed = 0;
        this.render();
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