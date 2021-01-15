
/*document.write('<link href="https://fonts.googleapis.com/css?family=News+Cycle:700" rel="stylesheet">');
document.write('<link href="page-translator.css" rel="stylesheet">');*/
var translator = {
    google: {
        url: "https://translate.google.com/translate?&sl=auto",
        to: "&tl=",
        website: "&u=",
        pageLang: '&hl=',
        iframeParent: 'https://translate.googleusercontent.com'

    },
    bing: {
        url: "https://www.translatetheweb.com/?from=",
        to: "&to=",
        website: "&a=",
        pageLang: '&dl=',
        iframeParent: 'https://www.translatetheweb'
    }
}

//console.log("translationProvider, defaultLang, selectedLangs, langs", translationProvider, defaultLang, selectedLangs, langs);

var firstRun = 1;
var pageLang=defaultLang;
defaultLang = defaultLang ? defaultLang : document.documentElement.lang.split("-")[0];
if (inIframe() && window.location.href.indexOf(translator[translationProvider].iframeParent) > -1) {
        defaultLang = document.documentElement.lang.split("-")[0];
        console.log('defaultLang', defaultLang);
    };

//console.log(defaultLang);
var defaultLangMore;
langs.forEach(function(item) {
    if (item.short == defaultLang) {
        defaultLangMore = item;
    }

});
translatoreaLink = translatoreaLink ? '<div class="lang-creator"><a href="https://euroalphabet.eu/" target="_blank">Auto Translate</a></div>' : '';
var btn1 = '<div class="translate_wrapper ' + translatoreaPosition + '"> <div class="translate_wrapper1 " id="trans-btn"> <div class="more_lang" id="trans-btn-more"> </div> <div onclick="showLangs()" class="current_lang"><div class="lang"> <img src="' + defaultLangMore.img + '"> <span class="lang-txt">' + defaultLangMore.short + '</span><div class="lang-arrow"></div></div> </div> </div>' + translatoreaLink + '</div>';

//document.body += btn1;
//document.write(btn1);
document.addEventListener("DOMContentLoaded", function() {
    // document.write(btn1);
    var elem = document.createElement('div');
    elem.innerHTML = btn1;
    document.body.appendChild(elem);
});



function showLangs() {
    if (firstRun == 1) {
        createLangs();
        firstRun = 0;

    }

    var element = document.getElementById("trans-btn");
    var element_more = document.getElementById("trans-btn-more");

    if (element.classList.contains('active')) {

        element.classList.remove("active");
        element_more.classList.remove("active");

    }
    else {
        element.classList.add("active");
        setTimeout(function() {
            element_more.classList.add("active");
        }, 5);
    }

}



console.log('defaultLang', defaultLang);
function createLangs() {
    var currentUrl = window.location.href;
    console.log('inIframe() && window.location.href.indexOf(translator[translationProvider].iframeParent) > -1', inIframe() && window.location.href.indexOf(translator[translationProvider].iframeParent) > -1, window.location.href);
    if (inIframe() && window.location.href.indexOf(translator[translationProvider].iframeParent) > -1) {
        currentUrl = document.getElementsByTagName('iframe')[0].baseURI;
    };

    var diver = document.createElement("div");
    diver.innerHTML = '';

    var engine = translator[translationProvider];

    langs.forEach(function(item) {
        if (selectedLangs.indexOf(item.short) !== -1) {
            //console.log(defaultLang == item.short, defaultLang, item.short)
            if (defaultLang == item.short) item.className = 'selected';
            var url= pageLang!==item.short ? (engine.url + engine.to + item.short + engine.pageLang + item.short + engine.website + currentUrl) : currentUrl;

            diver.innerHTML += '<a href="' + url + '"  target="_top" class="lang ' + item.className + '" data-value="' + item.short + '"> <img src="' + item.img + '"> <span class="lang-txt">' + item.name + '</span> </a>';


        }
    });
    document.getElementById("trans-btn-more").appendChild(diver);


    //document.getElementById("trans-btn-more").appendChild(div);

}





function inIframe() {
    try {
        return window.self !== window.top;
    }
    catch (e) {
        return true;
    }
}﻿﻿
﻿