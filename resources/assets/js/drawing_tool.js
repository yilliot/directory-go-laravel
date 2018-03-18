window.onload = function() {

    DrawingSet = new Object;
    
    // Register element
    DrawingSet.mapSrc = document.getElementById('map');
    DrawingSet.canvas = document.getElementById('canvas');
    DrawingSet.textInput = document.getElementById('text');
    DrawingSet.undoButton = document.getElementById('undo');
    DrawingSet.redoButton = document.getElementById('redo');
    DrawingSet.textBlack = document.getElementById('text-black');
    DrawingSet.textWhite = document.getElementById('text-white');
    DrawingSet.poligonTool = document.getElementById('poligon-tool');
    DrawingSet.zoomTool = document.getElementById('zoom-tool');
    DrawingSet.dragTool = document.getElementById('drag-tool');
    DrawingSet.clearButton = document.getElementById('clear');
    DrawingSet.fontSize = document.getElementById('font-size');
    DrawingSet.fontColor = document.getElementById('font-color');

    // Canvas context
    DrawingSet.ctx = this.canvas.getContext('2d');

    DrawingSet.map = new Image();
    DrawingSet.map.src = DrawingSet.mapSrc.value;
    DrawingSet.map.onload = () => {
        DrawingSet.ctx.drawImage(DrawingSet.map, 0, 0, DrawingSet.canvas.width, DrawingSet.canvas.height);
    };
    
    // Tool status
    DrawingSet.activeTool = null;
    DrawingSet.dragging = false;
    
    // Data initialize
    DrawingSet.data = new Object;
    
    // Zoom
    DrawingSet.scale = [1, 1];
    
    // Translation
    DrawingSet.dragStart = {x: 0, y: 0};            // Record the coordinate for the mousehold started
    DrawingSet.offsetBuffer = {x: 0, y: 0};         // Animated rendering according to offset buffer 
    DrawingSet.offsetBufferPoligon = {x: 0, y: 0};  // Animated rendering according to offset buffer for poligon
    DrawingSet.offsetBufferText = {x: 0, y: 0};     // Animated rendering according to offset buffer for text
    DrawingSet.offset = {x: 0, y: 0};               // Offset for overall
    
    // Geometry
    DrawingSet.data.geometry = {points:[], color: '', completed: 0, x: 0, y: 0};
    DrawingSet.data.helper = {activated: 0, x: 0, y:0}
    
    // Text
    DrawingSet.data.text = {text: null, color: 'black', size: '100px', x: 100, y: 100};
    
    // History
    DrawingSet.history = [];
    
    // Future
    DrawingSet.future = [];
    
    // Methods
    DrawingSet.render = function(type) {
        switch(type) {
            case 'undo':
                if(this.history.length > 1) this.future.unshift(this.history.shift());
                this.textInput.value = this.history[0].text.text;
                this.data = JSON.parse(JSON.stringify(this.history[0]));
                break;
            case 'redo':
                if(this.future.length > 0) this.history.unshift(this.future.shift());
                this.textInput.value = this.history[0].text.text;
                this.data = JSON.parse(JSON.stringify(this.history[0]));
                break;
            case 'helper':
            case 'drag':
            case 'zoom':
                break;
            default:
                if(this.data.geometry.completed == 1) {
                    this.history.shift();
                    this.history.shift();
                }
            case 'poligon-offset':
            case 'text-offset':
                this.future = [];
                this.history.unshift(JSON.parse(JSON.stringify(this.data)));

        }
        if(this.activeTool == 'poligon')this.canvas.style.cursor = this.data.geometry.completed ? this.dragging ? '-webkit-grabbing': '-webkit-grab': 'crosshair';

        if(type == 'zoom')this.ctx.scale(1/this.scale[1], 1/this.scale[1]);
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        if(type == 'zoom')this.ctx.scale(this.scale[0], this.scale[0]);
        if(this.dragging) this.ctx.translate(this.offsetBuffer.x, this.offsetBuffer.y);
        else this.ctx.translate(this.offset.x, this.offset.y);
        
        // map
        this.ctx.drawImage(this.map, 0, 0, this.canvas.width, this.canvas.height);

        // text displaying
        if(this.history[0].text.text) {
            this.ctx.beginPath();
            if(this.dragging) this.ctx.translate(this.offsetBufferText.x, this.offsetBufferText.y);
            else this.ctx.translate(this.history[0].text.x, this.history[0].text.y);
            this.ctx.font = this.history[0].text.size + ' Georgia';
            this.ctx.fillStyle = this.history[0].text.color;
            this.ctx.fillText(this.history[0].text.text, 0, 0);
            if(this.dragging) this.ctx.translate(-this.offsetBufferText.x, -this.offsetBufferText.y);
            else this.ctx.translate(-this.history[0].text.x, -this.history[0].text.y);
            this.ctx.fill();
        }
        // drawing displaying
        if(this.history[0].geometry.points.length) {
            this.ctx.beginPath();
            this.ctx.globalAlpha = 0.5;
            this.ctx.fillStyle = this.history[0].geometry.color;
            this.ctx.strokeStyle = this.history[0].geometry.color;
            let points = this.history[0].geometry.points;
            if(this.dragging) this.ctx.translate(this.offsetBufferPoligon.x, this.offsetBufferPoligon.y);
            else this.ctx.translate(this.history[0].geometry.x, this.history[0].geometry.y);
            for(let x in points) {
                if(x == 0)this.ctx.moveTo(points[x].x, points[x].y);
                else this.ctx.lineTo(points[x].x, points[x].y);
            }
            if(type != 'undo' && type != 'redo') {
                this.ctx.lineTo(this.data.helper.x, this.data.helper.y);
                if(points.length > 1)this.ctx.fill();
                else this.ctx.stroke();
            } else {
                if(points.length > 2)this.ctx.fill();
                else this.ctx.stroke();
            }
            this.ctx.globalAlpha = 1;
            if(this.dragging) this.ctx.translate(-this.offsetBufferPoligon.x, -this.offsetBufferPoligon.y);
            else this.ctx.translate(-this.history[0].geometry.x, -this.history[0].geometry.y);

        }
        if(this.dragging) this.ctx.translate(-this.offsetBuffer.x, -this.offsetBuffer.y);
        else this.ctx.translate(-this.offset.x, -this.offset.y);

    }
    // Text
    DrawingSet.textChange = function(text) {
        this.data.text.text = text;
        this.render();
    }
    DrawingSet.textColorChange = function(color) {
        this.data.text.color = color;
        this.render();
    }
    DrawingSet.sizeChange = function(size) {
        this.data.text.size = size + 'px';
        this.render();
    }

    // History
    DrawingSet.undo = function() {
        this.render('undo');
    }
    DrawingSet.redo = function() {
        this.render('redo');
    }

    // Poligon tool
    DrawingSet.createPoint = function(x, y) {
        if(!this.data.geometry.completed) {
            if(!this.data.helper.activated){
                this.data.helper.activated = 1;
                this.data.helper.x = x / this.scale[0] - this.offset.x;
                this.data.helper.y = y / this.scale[0] - this.offset.y;
                this.data.geometry.points = [];
            }
            this.data.geometry.points.push({x: x / this.scale[0] - this.offset.x, y: y / this.scale[0] - this.offset.y});
            this.render('create-point');
        }
            
    }
    DrawingSet.showLine = function(x, y) {
        if(this.data.helper.activated) {
            this.data.helper.x = x / this.scale[0] - this.offset.x;
            this.data.helper.y = y / this.scale[0] - this.offset.y;
            this.render('helper');
        }
    }
    DrawingSet.completeDrawing = function() {
        this.data.helper.activated = 0;
        this.data.geometry.completed = 1;
        this.render();
    }
    DrawingSet.poligonColorChange = function(color) {
        this.data.geometry.color = color;
        this.render();
    }
    DrawingSet.geometryColorChange = function(color) {
        this.data.geometry.color = color;
        this.render();
    }

    // Zoom tool
    DrawingSet.zoom = function() {
        this.scale[0] = this.scale[0] == 1? 2: 1;
        this.scale[1] = this.scale[0] == 1? 2: 1;
        this.canvas.style.cursor = this.scale[0] == 1? 'zoom-in': 'zoom-out';
        this.render('zoom');
    }
    DrawingSet.drag = function(x, y) {
        this.offsetBuffer.x = this.offset.x + x - this.dragStart.x;
        this.offsetBuffer.y = this.offset.y + y - this.dragStart.y;
        this.render('drag');
    }

    DrawingSet.dragInit = function(x, y) {
        this.canvas.style.cursor = '-webkit-grabbing';
        this.dragging = true;
        this.dragStart.x = x;
        this.dragStart.y = y;
        this.render('drag');
        // console.log(this.dragStart);
    }
    DrawingSet.dragEnd = function() {
        this.offset.x = this.offsetBuffer.x;
        this.offset.y = this.offsetBuffer.y;
        this.canvas.style.cursor = '-webkit-grab';
        this.dragging = false;
        this.render('drag');
    }
    DrawingSet.clear = function() {
        this.data.geometry.points = [];
        this.data.geometry.completed = 0;
        this.data.geometry.x = 0;
        this.data.geometry.y = 0;
        this.render();
    }
    // Drag Poligon
    DrawingSet.dragPoligon = function(x, y) {
        this.offsetBufferPoligon.x = this.data.geometry.x + x - this.dragStart.x;
        this.offsetBufferPoligon.y = this.data.geometry.y + y - this.dragStart.y;
        this.render('drag');
    }
    DrawingSet.dragPoligonEnd = function() {
        this.data.geometry.x = this.offsetBufferPoligon.x;
        this.data.geometry.y = this.offsetBufferPoligon.y;
        this.canvas.style.cursor = '-webkit-grab';
        this.dragging = false;
        this.render('poligon-offset');
    }
    // Drag Text
    DrawingSet.dragText = function(x, y) {
        this.offsetBufferText.x = this.data.text.x + x - this.dragStart.x;
        this.offsetBufferText.y = this.data.text.y + y - this.dragStart.y;
        this.render('drag');
    }
    DrawingSet.dragTextEnd = function() {
        this.data.text.x = this.offsetBufferText.x;
        this.data.text.y = this.offsetBufferText.y;
        this.canvas.style.cursor = '-webkit-grab';
        this.dragging = false;
        this.render('text-offset');
    }

    // Toggle tool
    DrawingSet.togglePoligon = function() {
        this.activeTool = this.activeTool == 'poligon'? null: 'poligon';
        this.canvas.style.cursor = this.activeTool == 'poligon'? 'crosshair': 'default';
    }
    DrawingSet.toggleZoom = function() {
        this.activeTool = this.activeTool == 'zoom'? null: 'zoom';
        this.canvas.style.cursor = this.activeTool == 'zoom'? this.scale[0] == 1? 'zoom-in': 'zoom-out': 'default';
    }
    DrawingSet.toggleDrag = function() {
        this.activeTool = this.activeTool == 'drag'? null: 'drag';
        this.canvas.style.cursor = this.activeTool == 'drag'? '-webkit-grab': 'default';
    }
    DrawingSet.activeText = function() {
        this.activeTool = this.activeTool = 'text';
        this.canvas.style.cursor = '-webkit-grab';
    }

    // Register function
    DrawingSet.textInput.onkeyup = function() {
        DrawingSet.textChange(this.value);
    }
    DrawingSet.fontSize.onchagne = function() {
        DrawingSet.sizeChange(this.value);
    }
    DrawingSet.fontColor.onchange = function() {
        DrawingSet.poligonColorChange(this.value);
    }
    DrawingSet.undoButton.onclick = function() {
        DrawingSet.undo();
    }
    DrawingSet.redoButton.onclick = function() {
        DrawingSet.redo();
    }
    DrawingSet.textBlack.onclick = function() {
        DrawingSet.textColorChange('black');
    }
    DrawingSet.textWhite.onclick = function() {
        DrawingSet.textColorChange('white');
    }
    DrawingSet.canvas.onmousedown = function() {
        switch(DrawingSet.activeTool) {
            case 'drag':
            case 'text':
                DrawingSet.dragInit(event.offsetX, event.offsetY);
                break;
            case 'poligon':
                if(DrawingSet.data.geometry.completed)DrawingSet.dragInit(event.offsetX, event.offsetY);
                break;
        }
    }
    DrawingSet.canvas.onmouseup = function() {
        switch(DrawingSet.activeTool) {
            case 'drag':
                DrawingSet.dragEnd();
                break;
            case 'poligon':
                if(DrawingSet.data.geometry.completed && DrawingSet.dragging)DrawingSet.dragPoligonEnd();
                break;
            case 'text':
                if(DrawingSet.dragging)DrawingSet.dragTextEnd();
                break;
        }
    }
    DrawingSet.canvas.onmouseleave = function(event) {
        switch(DrawingSet.activeTool) {
            case 'drag':
                if(DrawingSet.dragging)DrawingSet.dragEnd();
                break;
            case 'poligon':
                if(DrawingSet.data.geometry.completed && DrawingSet.dragging)DrawingSet.dragPoligonEnd();
                break;
            case 'text':
                if(DrawingSet.dragging)DrawingSet.dragTextEnd();
                break;
        }
    }
    DrawingSet.canvas.onmousemove = function(event) {
        switch(DrawingSet.activeTool) {
            case 'poligon':
                if(DrawingSet.dragging)DrawingSet.dragPoligon(event.offsetX, event.offsetY);
                else DrawingSet.showLine(event.offsetX, event.offsetY);
                break;
            case 'drag': 
                if(DrawingSet.dragging)DrawingSet.drag(event.offsetX, event.offsetY);
                break;
            case 'text':
                if(DrawingSet.dragging)DrawingSet.dragText(event.offsetX, event.offsetY);
        }
    }
    DrawingSet.canvas.onclick = function(event) {
        switch(DrawingSet.activeTool) {
            case 'poligon':
                DrawingSet.createPoint(event.offsetX, event.offsetY);
                break;
            case 'zoom':
                DrawingSet.zoom();
                break;
        }
    }
    DrawingSet.canvas.ondblclick = function() {
        switch(DrawingSet.activeTool) {
            case 'poligon':
                DrawingSet.completeDrawing();
                break;
        }
    }
    DrawingSet.poligonTool.onclick = function() {
        DrawingSet.togglePoligon();
    }
    DrawingSet.zoomTool.onclick = function() {
        DrawingSet.toggleZoom();
    }
    DrawingSet.dragTool.onclick = function() {
        DrawingSet.toggleDrag();
    }
    DrawingSet.clearButton.onclick = function() {
        DrawingSet.clear();
    }
    DrawingSet.textInput.onclick = function() {
        DrawingSet.activeText();
    }

    // Start display
    DrawingSet.render();
}