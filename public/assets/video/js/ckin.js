/*!
   ckin v0.0.1: Custom HTML5 Video Player Skins.
   (c) 2017 
   MIT License
   git+https://github.com/hunzaboy/ckin.git
*/
// Source: https://gist.github.com/k-gun/c2ea7c49edf7b757fe9561ba37cb19ca;

var timeout = null;
var isFullscreen = false;

(function () {
    // helpers
    var regExp = function regExp(name) {
        return new RegExp('(^| )' + name + '( |$)');
    };
    var forEach = function forEach(list, fn, scope) {
        for (var i = 0; i < list.length; i++) {
            fn.call(scope, list[i]);
        }
    };

    // class list object with basic methods
    function ClassList(element) {
        this.element = element;
    }

    ClassList.prototype = {
        add: function add() {
            forEach(arguments, function (name) {
                if (!this.contains(name)) {
                    this.element.className += ' ' + name;
                }
            }, this);
        },
        remove: function remove() {
            forEach(arguments, function (name) {
                this.element.className = this.element.className.replace(regExp(name), '');
            }, this);
        },
        toggle: function toggle(name) {
            return this.contains(name) ? (this.remove(name), false) : (this.add(name), true);
        },
        contains: function contains(name) {
            return regExp(name).test(this.element.className);
        },
        // bonus..
        replace: function replace(oldName, newName) {
            this.remove(oldName), this.add(newName);
        }
    };

    // IE8/9, Safari
    if (!('classList' in Element.prototype)) {
        Object.defineProperty(Element.prototype, 'classList', {
            get: function get() {
                return new ClassList(this);
            }
        });
    }

    // replace() support for others
    if (window.DOMTokenList && DOMTokenList.prototype.replace == null) {
        DOMTokenList.prototype.replace = ClassList.prototype.replace;
    }
})();
(function () {
    if (typeof NodeList.prototype.forEach === "function") return false;
    NodeList.prototype.forEach = Array.prototype.forEach;
})();

// Unfortunately, due to scattered support, browser sniffing is required
function browserSniff() {
    var nVer = navigator.appVersion,
        nAgt = navigator.userAgent,
        browserName = navigator.appName,
        fullVersion = '' + parseFloat(navigator.appVersion),
        majorVersion = parseInt(navigator.appVersion, 10),
        nameOffset,
        verOffset,
        ix;

    // MSIE 11
    if (navigator.appVersion.indexOf("Windows NT") !== -1 && navigator.appVersion.indexOf("rv:11") !== -1) {
        browserName = "IE";
        fullVersion = "11;";
    }
    // MSIE
    else if ((verOffset = nAgt.indexOf("MSIE")) !== -1) {
        browserName = "IE";
        fullVersion = nAgt.substring(verOffset + 5);
    }
    // Chrome
    else if ((verOffset = nAgt.indexOf("Chrome")) !== -1) {
        browserName = "Chrome";
        fullVersion = nAgt.substring(verOffset + 7);
    }
    // Safari
    else if ((verOffset = nAgt.indexOf("Safari")) !== -1) {
        browserName = "Safari";
        fullVersion = nAgt.substring(verOffset + 7);
        if ((verOffset = nAgt.indexOf("Version")) !== -1) {
            fullVersion = nAgt.substring(verOffset + 8);
        }
    }
    // Firefox
    else if ((verOffset = nAgt.indexOf("Firefox")) !== -1) {
        browserName = "Firefox";
        fullVersion = nAgt.substring(verOffset + 8);
    }
    // In most other browsers, "name/version" is at the end of userAgent
    else if ((nameOffset = nAgt.lastIndexOf(' ') + 1) < (verOffset = nAgt.lastIndexOf('/'))) {
        browserName = nAgt.substring(nameOffset, verOffset);
        fullVersion = nAgt.substring(verOffset + 1);
        if (browserName.toLowerCase() == browserName.toUpperCase()) {
            browserName = navigator.appName;
        }
    }
    // Trim the fullVersion string at semicolon/space if present
    if ((ix = fullVersion.indexOf(";")) !== -1) {
        fullVersion = fullVersion.substring(0, ix);
    }
    if ((ix = fullVersion.indexOf(" ")) !== -1) {
        fullVersion = fullVersion.substring(0, ix);
    }
    // Get major version
    majorVersion = parseInt('' + fullVersion, 10);
    if (isNaN(majorVersion)) {
        fullVersion = '' + parseFloat(navigator.appVersion);
        majorVersion = parseInt(navigator.appVersion, 10);
    }
    // Return data
    return [browserName, majorVersion];
}

var obj = {};
obj.browserInfo = browserSniff();
obj.browserName = obj.browserInfo[0];
obj.browserVersion = obj.browserInfo[1];

wrapPlayers();
/* Get Our Elements */
var players = document.querySelectorAll('.ckin__player');

var iconPlay = '<i class="fa fa-play"></i>';
var iconPause = '<i class="fa fa-pause"></i>';
var iconVolumeMute = '<i class="ckin-volume-mute"></i>';
var iconVolumeMedium = '<i class="ckin-volume-medium"></i>';
var iconVolumeLow = '<i class="ckin-volume-low"></i>';
var iconExpand = '<i class="ckin-expand"></i>';
var iconCompress = '<i class="ckin-compress"></i>';
var iconDownload = '<i class="fa fa-download"></i>';           //atiq
var iconSubtitle = '<i class="fa fa-cc"></i>';                //atiq
var iconStar = '<i class="fa fa-star"></i>';                  //atiq


players.forEach(function (player) {
    var video = player.querySelector('video');

    var skin = attachSkin(video.dataset.ckin);
    player.classList.add(skin);

    var overlay = video.dataset.overlay;
    addOverlay(player, overlay);

    var title = showTitle(skin, video.dataset.title);
    if (title) {
        player.insertAdjacentHTML('beforeend', title);
    }

    var html = buildControls(skin);
    player.insertAdjacentHTML('beforeend', html);

    var color = video.dataset.color;
    addColor(player, color);

    var playerControls = player.querySelector('.' + skin + '__controls');
    var progress = player.querySelector('.progress');
    var progressBar = player.querySelector('.progress__filled');
    var toggle = player.querySelectorAll('.toggle');
    var skipButtons = player.querySelectorAll('[data-skip]');
    var ranges = player.querySelectorAll('.' + skin + '__slider');
    var volumeButton = player.querySelector('.volume');
    var fullScreenButton = player.querySelector('.fullscreen');
    var download = player.querySelector(".download");                    //rashik

    if (obj.browserName === "IE" && (obj.browserVersion === 8 || obj.browserVersion === 9)) {
        showControls(video);
        playerControls.style.display = "none";
    }

    video.addEventListener('click', function () {
        togglePlay(this, player);
    });
    video.addEventListener('play', function () {
        updateButton(this, toggle);
    });

    video.addEventListener('pause', function () {
        updateButton(this, toggle);
    });
    video.addEventListener('timeupdate', function () {
        handleProgress(this, progressBar);
    });

    toggle.forEach(function (button) {
        return button.addEventListener('click', function () {
            togglePlay(video, player);
        });
    });
    volumeButton.addEventListener('click', function () {
        toggleVolume(video, volumeButton);
    });

    download.addEventListener('click',function () {                         //rashik
        console.log("a");
    });



    var mousedown = false;
    progress.addEventListener('click', function (e) {
        scrub(e, video, progress);
    });
    progress.addEventListener('mousemove', function (e) {
        return mousedown && scrub(e, video, progress);
    });
    progress.addEventListener('mousedown', function () {
        return mousedown = true;
    });
    progress.addEventListener('mouseup', function () {
        return mousedown = false;
    });
    fullScreenButton.addEventListener('click', function (e) {
        return toggleFullScreen(player, fullScreenButton);
    });
    addListenerMulti(player, 'webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange', function (e) {
        return onFullScreen(e, player);
    });
});

function showControls(video) {

    video.setAttribute("controls", "controls");
}

function togglePlay(video, player) {
    var method = video.paused ? 'play' : 'pause';
    video[method]();
    video.paused ? player.classList.remove('is-playing') : player.classList.add('is-playing');
}

function updateButton(video, toggle) {
    var icon = video.paused ? iconPlay : iconPause;
    toggle.forEach(function (button) {
        return button.innerHTML = icon;
    });
}

function skip() {
    video.currentTime += parseFloat(this.dataset.skip);
}

function toggleVolume(video, volumeButton) {
    var level = video.volume;
    var icon = iconVolumeMedium;
    if (level == 1) {
        level = 0;
        icon = iconVolumeMute;
    } else if (level == 0.5) {
        level = 1;
        icon = iconVolumeMedium;
    } else {
        level = 0.5;
        icon = iconVolumeLow;
    }
    video['volume'] = level;
    volumeButton.innerHTML = icon;
}

function handleRangeUpdate() {
    video[this.name] = this.value;
}

function handleProgress(video, progressBar) {
    var percent = video.currentTime / video.duration * 100;
    progressBar.style.flexBasis = percent + '%';

}

function scrub(e, video, progress) {
    var scrubTime = e.offsetX / progress.offsetWidth * video.duration;
    video.currentTime = scrubTime;
    console.log(video.currentTime);
    console.log(scrubTime);
}

function wrapPlayers() {

    var videos = document.querySelectorAll('video');

    videos.forEach(function (video) {

        var wrapper = document.createElement('div');
        wrapper.classList.add('ckin__player');

        video.parentNode.insertBefore(wrapper, video);

        wrapper.appendChild(video);
    });
}

function buildControls(skin) {
    var html = [];
    var poster = document.getElementById("videoPlay");
    var src_poster = poster.getAttribute("poster");
    var title = poster.getAttribute("title");
    var src = poster.getAttribute('src');
    var imdb = poster.getAttribute('imdb');

    html.push('<div id="total">');

    html.push('<div class="poster_image"><img id="poster"  class="poster" src='+  src_poster +'></div>');

    html.push('<div><h1 id="title" class="title heading" style="position:absolute; top:63%; left: 15%; font-size: 30px; ">'+ title+'</h1></div>')

    html.push('<div><h1 id="rating" class="title heading" style="position:absolute; top:74%; left: 15%; font-size: 14px; ">IMDB: '+ imdb+'</h1></div>')

    html.push('<button class="' + skin + '__button--big toggle" title="Toggle Play">' + iconPlay + '</button>');

    html.push('<div id="controls" class="' + skin + '__controls ckin__controls">');

    html.push('<button class="' + skin + '__button toggle" title="Toggle Video">' + iconPlay + '</button>', '<div class="progress">', '<div class="progress__filled"></div>', '</div>', '<button class="' + skin + '__button volume" title="Volume">' + iconVolumeMedium + '</button>','<button class="' + skin + '__button subtitle" title="Subtitle Video">' + iconSubtitle + '</button>','<button onclick="download()" class="' + skin + '__button download" title="Download Video">' + iconDownload + '</button>', '<button class="' + skin + '__button fullscreen" title="Full Screen">' + iconExpand + '</button>');

    html.push('</div>');

    html.push('</div>');

    return html.join('');
}

function attachSkin(skin) {
    if (typeof skin != 'undefined' && skin != '') {
        return skin;
    } else {
        return 'default';
    }
}

function showTitle(skin, title) {
    if (typeof title != 'undefined' && title != '') {
        return '<div class="' + skin + '__title">' + title + '</div>';
    } else {
        return false;
    }
}

function addOverlay(player, overlay) {

    if (overlay == 1) {
        player.classList.add('ckin__overlay');
    } else if (overlay == 2) {
        player.classList.add('ckin__overlay--2');
    } else {
        return;
    }
}

function addColor(player, color) {
    if (typeof color != 'undefined' && color != '') {
        var buttons = player.querySelectorAll('button');
        var progress = player.querySelector('.progress__filled');
        progress.style.background = color;
        buttons.forEach(function (button) {
            return button.style.color = color;
        });
    }
}

function toggleFullScreen(player, fullScreenButton) {
    // let isFullscreen = false;
    var videoPlay =  document.getElementById("videoPlay");

    if (!document.fullscreenElement && // alternative standard method
        !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) { //add fullscreen
        player.classList.add('ckin__fullscreen');
        player.classList.remove('poster_image');
        if (player.requestFullscreen) {
            player.requestFullscreen();
        } else if (player.mozRequestFullScreen) {
            player.mozRequestFullScreen(); // Firefox
        } else if (player.webkitRequestFullscreen) {
            player.webkitRequestFullscreen(); // Chrome and Safari
        } else if (player.msRequestFullscreen) {
            player.msRequestFullscreen();
        }
        isFullscreen = true;

        fullScreenButton.innerHTML = iconCompress;


        /*Rashik code*/
        videoPlay.addEventListener("mousemove",FullScreenIdleMouse);         //active mousemove transition
        contentTransition("-345px","52px","-1000px");

    } else {   //remove fullscrin
        player.classList.remove('ckin__fullscreen');
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
        isFullscreen = false;
        fullScreenButton.innerHTML = iconExpand;

        /* Rashik code */

        videoPlay.removeEventListener("mousemove",FullScreenIdleMouse);           //disable mousemove
        clearTimeout(timeout);//clear timeout when exiting fullscreen
        contentTransition("-345px","52px","-1000px");
        player.addEventListener("mouseenter",enterFromOut);
        player.addEventListener("mouseleave",leaveFromIn);

    }
}


/*  This two method is written because when exiting full-screen,poster transition don't work on transform anymore */

function leaveFromIn() {
    console.log("a");
    contentTransition("-345px","52px","-1000px");
}

function enterFromOut() {
    console.log("b");
    contentTransition("0","0","0");

}

function onFullScreen(e, player) {
    var isFullscreenNow = document.webkitFullscreenElement !== null;
    if (!isFullscreenNow) {                                               //screen is full
        player.classList.remove('ckin__fullscreen');
        player.querySelector('.fullscreen').innerHTML = iconExpand;
        document.getElementById("title").style.top = '63%';
        document.getElementById("rating").style.top = '74%';

    } else {                                                              //screen is not full
         document.getElementById("title").style.top = '50%';
         document.getElementById("rating").style.top = '55%';
    }
}

function addListenerMulti(element, eventNames, listener) {
    var events = eventNames.split(' ');
    for (var i = 0, iLen = events.length; i < iLen; i++) {
        element.addEventListener(events[i], listener, false);
    }
}

function FullScreenIdleMouse () {
    contentTransition("0px","0px","0px");               // on hover visible
    if(timeout!== null){
        clearTimeout(timeout);
    }
    timeout = setTimeout(function() {
        contentTransition("-345px","52px","-1000px");              //after 2 seconds of hove,invisible
    },2000);

}

function contentTransition(posterValue,controlValue,titleValue) {

    var poster = document.getElementById("poster");
    var controls = document.getElementById("controls");
    poster.style.webkitTransform = "translateX("+posterValue+")";
    poster.style.transform = "translateX("+posterValue+")";
    controls.style.webkitTransform = "translateY("+controlValue+")";
    controls.style.transform = "translateY("+controlValue+")";

    document.getElementById("title").style.transform = "translateX("+titleValue +")";
    document.getElementById("title").style.webkitTransform = "translateX("+titleValue +")";
    document.getElementById("rating").style.transform = "translateX("+titleValue +")";
    document.getElementById("rating").style.webkitTransform = "translateX("+titleValue +")";



}

function download() {
    var poster = document.getElementById("videoPlay");
    var src = poster.getAttribute('src');
    window.open(src);
}


