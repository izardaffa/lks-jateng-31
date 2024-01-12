let sec = 0
let counter = 0

function start() {
    timer = true
    stopwatch()
}

function stop() {
    timer = false
}

function reset() {
    timer = false
    sec = 0
    counter = 0

    document.getElementById("sec").innerHTML = "000"
    document.getElementById("counter").innerHTML = "00"
}

function stopwatch() {
    if (timer) {
        counter++

        if (counter == 59) {
            sec++
            counter = 0
        }

        let counterStr = counter
        let secStr = sec

        if (counter < 10) {
            counterStr = "0" + counter
        }

        if (sec < 10) {
            secStr = "00" + sec
        } else if (sec < 100) {
            secStr = "0" + sec
        }

        document.getElementById("sec").innerHTML = secStr
        document.getElementById("counter").innerHTML = counterStr

        if (sec < 1000) {
            setTimeout(stopwatch, 10)
        } else {
            document.getElementById("sec").innerHTML = "999"
            document.getElementById("counter").innerHTML = "59"
        }
    }
}