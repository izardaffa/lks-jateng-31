function startCanvas() {
    myCanvas.start()
    myCircle = new component(30, 30, "white", 10, 145)
}

let myCanvas = {
    canvas: document.getElementById("canvas"),
    start: function() {
        this.canvas.width = 400
        this.canvas.height = 320
        this.context = this.canvas.getContext("2d")
        this.interval = setInterval(updateCanvasArea, 20)
    },
    clear: function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height)
    }
}

function component(width, height, color, x, y) {
    this.width = width
    this.height = height
    this.y = y
    this.x = x
    this.update = function() {
        ctx = myCanvas.context
        ctx.fillStyle = color

        ctx.beginPath()
        ctx.arc(this.x + (this.width / 2), this.y + (this.width / 2), (this.width / 2), 0, 2 * Math.PI)
        ctx.fill()
        ctx.closePath()

        ctx.beginPath()
        ctx.arc(this.x + (this.width / 2) - myCanvas.canvas.width, this.y + (this.width / 2), (this.width / 2), 0, 2 * Math.PI)
        ctx.fill()
        ctx.closePath()
    }
}

function updateCanvasArea() {
    myCanvas.clear()
    myCircle.x += 1

    if (myCircle.x == myCanvas.canvas.width) {
        myCircle.x = 0
    }

    myCircle.update()
}

// Note:
// Koordinat dan ukuran shape berpengaruh dalam penganimasian.