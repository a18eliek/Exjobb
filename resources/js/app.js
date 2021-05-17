
helpers = {
    timerStart: function(func, file) {
        window['timer_' + file + '_' + func] = new Date();
        console.log(
            `%c [${helpers.timeStamp()}] %c start %c ${file} %c ${func} %c `,
            'background:#35495e ; padding: 1px; border-radius: 3px 0 0 3px;  color: #fff',
            'background:#41b883 ; padding: 1px; border-radius: 0 0 0 0;  color: #fff',
            'background:#A9329F ; padding: 1px; border-radius: 0 0 0 0;  color: #fff',
            'background:#2F329F ; padding: 1px; border-radius: 0 3px 3px 0;  color: #fff',
            'background:transparent'
          );
    },
    timerEnd: function(func, file) {
        var curTime = new Date();
        console.log(
            `%c [${helpers.timeStamp()}] %c end   %c ${file} %c ${func} %c Time: ${(curTime - window['timer_' + file + '_' + func])} ms %c `,
            'background:#35495e ; padding: 1px; border-radius: 3px 0 0 3px;  color: #fff',
            'background:#ff4c4c ; padding: 1px; border-radius: 0 0 0 0;  color: #fff',
            'background:#A9329F ; padding: 1px; border-radius: 0 0 0 0;  color: #fff',
            'background:#2F329F ; padding: 1px; border-radius: 0 0 0 0;  color: #fff',
            'background:#35495e ; padding: 1px; border-radius: 0 3px 3px 0;  color: #fff',
            'background:transparent'
          );

        /*
        * Datacollection
        */

        // Everything
        localStorage.setItem("datacollection_all", localStorage.getItem("datacollection_all") + `\n${file.split('.').pop()},${file},${func},${(curTime - window['timer_' + file + '_' + func])}`);
          
        // Framwork specific - only vue or react
        localStorage.setItem(`datacollection_${file.split('.').pop()}`, localStorage.getItem(`datacollection_${file.split('.').pop()}`) + `\n${file.split('.').pop()},${file},${func},${(curTime - window['timer_' + file + '_' + func])}`);
       
        // Framwork specific with file and function
        localStorage.setItem(`datacollection_${file.split('.').pop()}_${file}_${func}`, localStorage.getItem(`datacollection_${file.split('.').pop()}_${file}_${func}`) + `\n${file.split('.').pop()},${file},${func},${(curTime - window['timer_' + file + '_' + func])}`);
          
        // File specific - Only barcharts or geocharts
        localStorage.setItem(`datacollection_${file.split('.').shift()}`, localStorage.getItem(`datacollection_${file.split('.').shift()}`) + `\n${file.split('.').pop()},${file},${func},${(curTime - window['timer_' + file + '_' + func])}`);
    
        // Auto refresh of page
        if (localStorage.getItem("autorefresh") === null) {
            localStorage.setItem("autorefresh", false);
        }

        if (localStorage.getItem("pages") === null || localStorage.getItem("pages") == "[]") {
            localStorage.setItem("pages", JSON.stringify(['/react/geochart', '/vue/geochart', '/react/barchart', '/vue/barchart']));
        }

        if (localStorage.getItem("maxitems") === null) {
            localStorage.setItem("maxitems", 2500);
        }
        
        if(func == "rendering" && localStorage.getItem("autorefresh") == "true") {
            // Counter for number of page refreshes
            if(localStorage.getItem(window.location.pathname) == null) {
                localStorage.setItem(window.location.pathname, 0);
            } else {
                localStorage.setItem(window.location.pathname, (parseInt(localStorage.getItem(window.location.pathname))+1));
            }
            
            // Move on to another graph
            if(parseInt(localStorage.getItem(window.location.pathname)) >= parseInt(localStorage.getItem("maxitems"))) {
                console.log(localStorage.getItem(window.location.pathname) + " is bigger than " + localStorage.getItem("maxitems"))
                var pages = JSON.parse(localStorage.getItem("pages"));
                
                // Remove the current page from the list, so we can move on
                pages = pages.filter(function(item) {
                    return item !== window.location.pathname;
                });
                
                localStorage.setItem("pages", JSON.stringify(pages));

                if (pages === undefined || pages.length == 0) {
                    alert("Datacollection is complete!");
                    localStorage.setItem("autorefresh", "false");
                } else {
                    window.location.href = pages[0];
                }
                
            } else {
                window.location.reload();
            }            
        }
    
    },
    timeStamp: function() {
        let d = new Date();
        // current hours
        let hours = d.getHours();

        // current minutes
        let minutes = (d.getMinutes() < 10 ? '0' : '') + d.getMinutes();

        // current seconds
        let seconds = (d.getSeconds() < 10 ? '0' : '') + d.getSeconds();

        // current milliseconds
        let milliseconds = (d.getMilliseconds() < 100 ? '0' : '') + d.getMilliseconds();

        // Return HH:mm:ss.S
        return hours + ":" + minutes + ":" + seconds + "." + milliseconds;
    },
    reverseObject: function(object) {
        var newObject = {};
        var keys = [];

        for (var key in object) {
            keys.push(key);
        }

        for (var i = keys.length - 1; i >= 0; i--) {
          var value = object[keys[i]];
          newObject[keys[i]]= value;
        }       

        return newObject;
    }
}

require('./bootstrap');
require('alpinejs');

global.$ = global.jQuery = require('jquery');