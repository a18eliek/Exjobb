
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
    },
    timeStamp: function() {
        let d = new Date();
        // current hours
        let hours = d.getHours();

        // current minutes
        let minutes = (d.getMinutes() < 10 ? '0' : '') + d.getMinutes();

        // current seconds
        let seconds = d.getSeconds();

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