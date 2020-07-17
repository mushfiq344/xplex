document.getElementById("second_image").onmouseover = function() {mouseOver()};
document.getElementById("third_image").onmouseover = function() {mouseOver3()};
document.getElementById("fourth_image").onmouseover = function() {mouseOver4()};
document.getElementById("fifth_image").onmouseover = function() {mouseOver5()};
document.getElementById("sixth_image").onmouseover = function() {mouseOver6()};
document.getElementById("seventh_image").onmouseover = function() {mouseOver7()};
document.getElementById("eighth_image").onmouseover = function() {mouseOver8()};
document.getElementById("ninth_image").onmouseover = function() {mouseOver9()};
document.getElementById("tenth_image").onmouseover = function() {mouseOver10()};


function mouseOver() {
	console.log("1");
	document.getElementById("main_image").style.backgroundImage ="url('assets/images/black-bg.jpg')";
	document.getElementById("main_image_name").innerHTML = "Black Panther";
}

function mouseOver3() {
	console.log("2");
    document.getElementById("main_image").style.backgroundImage ="url('assets/images/taken-bg.jpg')";
	document.getElementById("main_image_name").innerHTML = "Taken 2";
}

function mouseOver4() {
	console.log("3");
    document.getElementById("main_image").style.backgroundImage ="url('assets/images/ff8-bg.jpg')";
	document.getElementById("main_image_name").innerHTML = "Fast & Furious 8";
}

function mouseOver5() {
	console.log("4");
    document.getElementById("main_image").style.backgroundImage ="url('assets/images/raone-bg.jpg')";
	document.getElementById("main_image_name").innerHTML = "Ra One";
}

function mouseOver6() {
	console.log("5");
    document.getElementById("main_image").style.backgroundImage ="url('assets/images/jumanji-bg.jpg')";
	document.getElementById("main_image_name").innerHTML = "Jumanji";
}

function mouseOver7() {
	console.log("6");
    document.getElementById("main_image").style.backgroundImage ="url('assets/images/madmax-bg.jpg')";
	document.getElementById("main_image_name").innerHTML = "Mad Max: The fury Road";
}

function mouseOver8() {
	console.log("1");
    document.getElementById("main_image").style.backgroundImage ="url('assets/images/inception-bg.jpg')";
	document.getElementById("main_image_name").innerHTML = "Inception";
}

function mouseOver9() {
	console.log("1");
    document.getElementById("main_image").style.backgroundImage ="url('assets/images/strange-bg.jpg')";
	document.getElementById("main_image_name").innerHTML = "Doctor Strange";
}

function mouseOver10() {
	console.log("1");
    document.getElementById("main_image").style.backgroundImage ="url('assets/images/baby-bg.jpg')";
	document.getElementById("main_image_name").innerHTML = "Baby Driver";
}

function fadeIn(el) {
    el.style.opacity = 0;
    var tick = function () {
        el.style.opacity = +el.style.opacity + 0.01;
        if (+el.style.opacity < 1) {
            (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
        }
    };
    tick();
}

