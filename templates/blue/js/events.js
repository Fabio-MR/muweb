var MuEvents = {};
MuEvents.text = [
        [lang[0], lang[1]],
        [lang[2], lang[3]]
];

MuEvents.sked = [
                 ['Blood Castle',        0,      '00:30', '02:30', '04:30', '06:30', '08:30', '10:30', '12:30', '14:30', '16:30', '18:30', '20:30', '22:30'],
                 ['Chaos Castle',        0,      '01:00', '03:00', '05:00', '07:00', '9:00', '11:00', '13:00', '15:00', '17:00', '19:00', '21:00', '23:00'],
                 ['Devil Square',        0,      '00:00', '02:00', '04:00', '06:00', '08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00', '22:00'],
                 ['Illusion Temple',     0,      '21:00'],
                 ['White Wizard',        1,      '01:20', '03:20', '05:20', '07:20', '09:20', '11:20', '13:20', '15:20', '17:20', '19:20', '21:20', '23:20'],
                 ['Golden Invasion',     1,      '01:30', '05:30', '09:30', '13:30', '17:30', '21:30'],
                 ['Red Dragon Invasion', 1,      '03:30', '07:30', '11:30', '15:30', '19:30', '23:30'],
                 ['Skeleton King',     	1,		'01:25', '03:25', '05:25', '07:25', '09:25', '11:25', '13:25', '15:25', '17:25', '19:25', '21:25', '23:25'],
                // ['Medusa Boss',         1,		'18:00'],
             //    ['Doppelganger',     0,      '12:20', '14:20', '16:20', '18:20', '20:20', '22:20', '00:20'],
                 ['Loren Deep',     	    1,		'21:45']
];

MuEvents.init = function (e) {

        if (typeof e == "string") var g = new Date(serverdate.toString().replace(/\d+:\d+:\d+/g, e));
        var f = (typeof e == "number" ? e : (g.getHours() * 60 + g.getMinutes()) * 60 + g.getSeconds()), q = MuEvents.sked, j = [];
        
        for (var a = 0; a < q.length; a++) {
                var n = q[a];
                for (var k = 2; k < q[a].length; k++) {
                        var b = 0, p = q[a][k].split(":"), o = (p[0] * 60 + p[1] * 1) * 60, c = q[a][2].split(":");
                        if (q[a].length - 1 == k && (o - f) < 0) b = 1;
                        var r = b ? (1440 * 60 - f) + ((c[0] * 60 + c[1] * 1) * 60) : o - f;
                        if (f <= o || b) {
                                var l = Math.floor((r / 60) / 60), l = l < 10 ? "0" + l : l, d = Math.floor((r / 60) % 60), d = d < 10 ? "0" + d : d, u = r % 60, u = u < 10 ? "0" + u : u;
                                j.push('<li class="event">' + (l == 0 && !q[a][1] && d < 5 ? '<i class="dot-online"></i> ' : '') + '<b class="rightfloat">' + q[a][b ? 2 : k] + "</b><b>" + n[0] + '</b><span><div class="rightfloat">' + (l + ":" + d + ":" + u) + "</div>" + (MuEvents.text[q[a][1]][+(l == 0 && d < (q[a][1] ? 1 : 5))]) + "</span>");
                                break;
                        };
                };
        };
        document.getElementById("events").innerHTML = j.join("");
        setTimeout(function () {
                MuEvents.init(f == 86400 ? 1 : ++f);
        }, 1000);
};