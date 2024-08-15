/*
 * bootstrap-tagsinput v0.8.0
 * 
 */

! function(a) {
    "use strict";

    function b(b, c) { this.isInit = !0, this.itemsArray = [], this.$element = a(b), this.$element.hide(), this.isSelect = "SELECT" === b.tagName, this.multiple = this.isSelect && b.hasAttribute("multiple"), this.objectItems = c && c.itemValue, this.placeholderText = b.hasAttribute("placeholder") ? this.$element.attr("placeholder") : "", this.inputSize = Math.max(1, this.placeholderText.length), this.$container = a('<div class="bootstrap-tagsinput"></div>'), this.$input = a('<input type="text" placeholder="' + this.placeholderText + '"/>').appendTo(this.$container), this.$element.before(this.$container), this.build(c), this.isInit = !1 }

    function c(a, b) {
        if ("function" != typeof a[b]) {
            var c = a[b];
            a[b] = function(a) { return a[c] }
        }
    }

    function d(a, b) {
        if ("function" != typeof a[b]) {
            var c = a[b];
            a[b] = function() { return c }
        }
    }

    function e(a) { return a ? i.text(a).html() : "" }

    function f(a) {
        var b = 0;
        if (document.selection) {
            a.focus();
            var c = document.selection.createRange();
            c.moveStart("character", -a.value.length), b = c.text.length
        } else(a.selectionStart || "0" == a.selectionStart) && (b = a.selectionStart);
        return b
    }

    function g(b, c) {
        var d = !1;
        return a.each(c, function(a, c) {
            if ("number" == typeof c && b.which === c) return d = !0, !1;
            if (b.which === c.which) {
                var e = !c.hasOwnProperty("altKey") || b.altKey === c.altKey,
                    f = !c.hasOwnProperty("shiftKey") || b.shiftKey === c.shiftKey,
                    g = !c.hasOwnProperty("ctrlKey") || b.ctrlKey === c.ctrlKey;
                if (e && f && g) return d = !0, !1
            }
        }), d
    }
    var h = { tagClass: function(a) { return "label label-info" }, focusClass: "focus", itemValue: function(a) { return a ? a.toString() : a }, itemText: function(a) { return this.itemValue(a) }, itemTitle: function(a) { return null }, freeInput: !0, addOnBlur: !0, maxTags: void 0, maxChars: void 0, confirmKeys: [13, 44], delimiter: ",", delimiterRegex: null, cancelConfirmKeysOnEmpty: !1, onTagExists: function(a, b) { b.hide().fadeIn() }, trimValue: !1, allowDuplicates: !1, triggerChange: !0 };
    b.prototype = {
        constructor: b,
        add: function(b, c, d) {
            var f = this;
            if (!(f.options.maxTags && f.itemsArray.length >= f.options.maxTags) && (b === !1 || b)) {
                if ("string" == typeof b && f.options.trimValue && (b = a.trim(b)), "object" == typeof b && !f.objectItems) throw "Can't add objects when itemValue option is not set";
                if (!b.toString().match(/^\s*$/)) {
                    if (f.isSelect && !f.multiple && f.itemsArray.length > 0 && f.remove(f.itemsArray[0]), "string" == typeof b && "INPUT" === this.$element[0].tagName) {
                        var g = f.options.delimiterRegex ? f.options.delimiterRegex : f.options.delimiter,
                            h = b.split(g);
                        if (h.length > 1) { for (var i = 0; i < h.length; i++) this.add(h[i], !0); return void(c || f.pushVal(f.options.triggerChange)) }
                    }
                    var j = f.options.itemValue(b),
                        k = f.options.itemText(b),
                        l = f.options.tagClass(b),
                        m = f.options.itemTitle(b),
                        n = a.grep(f.itemsArray, function(a) { return f.options.itemValue(a) === j })[0];
                    if (!n || f.options.allowDuplicates) {
                        if (!(f.items().toString().length + b.length + 1 > f.options.maxInputLength)) {
                            var o = a.Event("beforeItemAdd", { item: b, cancel: !1, options: d });
                            if (f.$element.trigger(o), !o.cancel) {
                                f.itemsArray.push(b);
                                var p = a('<span class="tag ' + e(l) + (null !== m ? '" title="' + m : "") + '">' + e(k) + '<span data-role="remove"></span></span>');
                                p.data("item", b), f.findInputWrapper().before(p), p.after(" ");
                                var q = a('option[value="' + encodeURIComponent(j) + '"]', f.$element).length || a('option[value="' + e(j) + '"]', f.$element).length;
                                if (f.isSelect && !q) {
                                    var r = a("<option selected>" + e(k) + "</option>");
                                    r.data("item", b), r.attr("value", j), f.$element.append(r)
                                }
                                c || f.pushVal(f.options.triggerChange), f.options.maxTags !== f.itemsArray.length && f.items().toString().length !== f.options.maxInputLength || f.$container.addClass("bootstrap-tagsinput-max"), a(".typeahead, .twitter-typeahead", f.$container).length && f.$input.typeahead("val", ""), this.isInit ? f.$element.trigger(a.Event("itemAddedOnInit", { item: b, options: d })) : f.$element.trigger(a.Event("itemAdded", { item: b, options: d }))
                            }
                        }
                    } else if (f.options.onTagExists) {
                        var s = a(".tag", f.$container).filter(function() { return a(this).data("item") === n });
                        f.options.onTagExists(b, s)
                    }
                }
            }
        },
        remove: function(b, c, d) {
            var e = this;
            if (e.objectItems && (b = "object" == typeof b ? a.grep(e.itemsArray, function(a) { return e.options.itemValue(a) == e.options.itemValue(b) }) : a.grep(e.itemsArray, function(a) { return e.options.itemValue(a) == b }), b = b[b.length - 1]), b) {
                var f = a.Event("beforeItemRemove", { item: b, cancel: !1, options: d });
                if (e.$element.trigger(f), f.cancel) return;
                a(".tag", e.$container).filter(function() { return a(this).data("item") === b }).remove(), a("option", e.$element).filter(function() { return a(this).data("item") === b }).remove(), a.inArray(b, e.itemsArray) !== -1 && e.itemsArray.splice(a.inArray(b, e.itemsArray), 1)
            }
            c || e.pushVal(e.options.triggerChange), e.options.maxTags > e.itemsArray.length && e.$container.removeClass("bootstrap-tagsinput-max"), e.$element.trigger(a.Event("itemRemoved", { item: b, options: d }))
        },
        removeAll: function() {
            var b = this;
            for (a(".tag", b.$container).remove(), a("option", b.$element).remove(); b.itemsArray.length > 0;) b.itemsArray.pop();
            b.pushVal(b.options.triggerChange)
        },
        refresh: function() {
            var b = this;
            a(".tag", b.$container).each(function() {
                var c = a(this),
                    d = c.data("item"),
                    f = b.options.itemValue(d),
                    g = b.options.itemText(d),
                    h = b.options.tagClass(d);
                if (c.attr("class", null), c.addClass("tag " + e(h)), c.contents().filter(function() { return 3 == this.nodeType })[0].nodeValue = e(g), b.isSelect) {
                    var i = a("option", b.$element).filter(function() { return a(this).data("item") === d });
                    i.attr("value", f)
                }
            })
        },
        items: function() { return this.itemsArray },
        pushVal: function() {
            var b = this,
                c = a.map(b.items(), function(a) { return b.options.itemValue(a).toString() });
            b.$element.val(c, !0), b.options.triggerChange && b.$element.trigger("change")
        },
        build: function(b) {
            var e = this;
            if (e.options = a.extend({}, h, b), e.objectItems && (e.options.freeInput = !1), c(e.options, "itemValue"), c(e.options, "itemText"), d(e.options, "tagClass"), e.options.typeahead) {
                var i = e.options.typeahead || {};
                d(i, "source"), e.$input.typeahead(a.extend({}, i, {
                    source: function(b, c) {
                        function d(a) {
                            for (var b = [], d = 0; d < a.length; d++) {
                                var g = e.options.itemText(a[d]);
                                f[g] = a[d], b.push(g)
                            }
                            c(b)
                        }
                        this.map = {};
                        var f = this.map,
                            g = i.source(b);
                        a.isFunction(g.success) ? g.success(d) : a.isFunction(g.then) ? g.then(d) : a.when(g).then(d)
                    },
                    updater: function(a) { return e.add(this.map[a]), this.map[a] },
                    matcher: function(a) { return a.toLowerCase().indexOf(this.query.trim().toLowerCase()) !== -1 },
                    sorter: function(a) { return a.sort() },
                    highlighter: function(a) { var b = new RegExp("(" + this.query + ")", "gi"); return a.replace(b, "<strong>$1</strong>") }
                }))
            }
            if (e.options.typeaheadjs) {
                var j = e.options.typeaheadjs;
                a.isArray(j) || (j = [null, j]);
                var k = j[1].valueKey,
                    l = k ? function(a) { return a[k] } : function(a) { return a };
                a.fn.typeahead.apply(e.$input, j).on("typeahead:selected", a.proxy(function(a, b) { e.add(l(b)), e.$input.typeahead("val", "") }, e))
            }
            e.$container.on("click", a.proxy(function(a) { e.$element.attr("disabled") || e.$input.removeAttr("disabled"), e.$input.focus() }, e)), e.options.addOnBlur && e.options.freeInput && e.$input.on("focusout", a.proxy(function(b) { 0 === a(".typeahead, .twitter-typeahead", e.$container).length && (e.add(e.$input.val()), e.$input.val("")) }, e)), e.$container.on({ focusin: function() { e.$container.addClass(e.options.focusClass) }, focusout: function() { e.$container.removeClass(e.options.focusClass) } }), e.$container.on("keydown", "input", a.proxy(function(b) {
                var c = a(b.target),
                    d = e.findInputWrapper();
                if (e.$element.attr("disabled")) return void e.$input.attr("disabled", "disabled");
                switch (b.which) {
                    case 8:
                        if (0 === f(c[0])) {
                            var g = d.prev();
                            g.length && e.remove(g.data("item"))
                        }
                        break;
                    case 46:
                        if (0 === f(c[0])) {
                            var h = d.next();
                            h.length && e.remove(h.data("item"))
                        }
                        break;
                    case 37:
                        var i = d.prev();
                        0 === c.val().length && i[0] && (i.before(d), c.focus());
                        break;
                    case 39:
                        var j = d.next();
                        0 === c.val().length && j[0] && (j.after(d), c.focus())
                }
                var k = c.val().length;
                Math.ceil(k / 5);
                c.attr("size", Math.max(this.inputSize, c.val().length))
            }, e)), e.$container.on("keypress", "input", a.proxy(function(b) {
                var c = a(b.target);
                if (e.$element.attr("disabled")) return void e.$input.attr("disabled", "disabled");
                var d = c.val(),
                    f = e.options.maxChars && d.length >= e.options.maxChars;
                e.options.freeInput && (g(b, e.options.confirmKeys) || f) && (0 !== d.length && (e.add(f ? d.substr(0, e.options.maxChars) : d), c.val("")), e.options.cancelConfirmKeysOnEmpty === !1 && b.preventDefault());
                var h = c.val().length;
                Math.ceil(h / 5);
                c.attr("size", Math.max(this.inputSize, c.val().length))
            }, e)), e.$container.on("click", "[data-role=remove]", a.proxy(function(b) { e.$element.attr("disabled") || e.remove(a(b.target).closest(".tag").data("item")) }, e)), e.options.itemValue === h.itemValue && ("INPUT" === e.$element[0].tagName ? e.add(e.$element.val()) : a("option", e.$element).each(function() { e.add(a(this).attr("value"), !0) }))
        },
        destroy: function() {
            var a = this;
            a.$container.off("keypress", "input"), a.$container.off("click", "[role=remove]"), a.$container.remove(), a.$element.removeData("tagsinput"), a.$element.show()
        },
        focus: function() { this.$input.focus() },
        input: function() { return this.$input },
        findInputWrapper: function() { for (var b = this.$input[0], c = this.$container[0]; b && b.parentNode !== c;) b = b.parentNode; return a(b) }
    }, a.fn.tagsinput = function(c, d, e) {
        var f = [];
        return this.each(function() {
            var g = a(this).data("tagsinput");
            if (g)
                if (c || d) {
                    if (void 0 !== g[c]) {
                        if (3 === g[c].length && void 0 !== e) var h = g[c](d, null, e);
                        else var h = g[c](d);
                        void 0 !== h && f.push(h)
                    }
                } else f.push(g);
            else g = new b(this, c), a(this).data("tagsinput", g), f.push(g), "SELECT" === this.tagName && a("option", a(this)).attr("selected", "selected"), a(this).val(a(this).val())
        }), "string" == typeof c ? f.length > 1 ? f : f[0] : f
    }, a.fn.tagsinput.Constructor = b;
    var i = a("<div />");
    a(function() { a("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput() })
}(window.jQuery);



/* flatpickr v4.6.9,, @license MIT */
! function(e, t) { "object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : (e = "undefined" != typeof globalThis ? globalThis : e || self).flatpickr = t() }(this, (function() {
    "use strict";
    var e = function() {
        return (e = Object.assign || function(e) {
            for (var t, n = 1, a = arguments.length; n < a; n++)
                for (var i in t = arguments[n]) Object.prototype.hasOwnProperty.call(t, i) && (e[i] = t[i]);
            return e
        }).apply(this, arguments)
    };

    function t() {
        for (var e = 0, t = 0, n = arguments.length; t < n; t++) e += arguments[t].length;
        var a = Array(e),
            i = 0;
        for (t = 0; t < n; t++)
            for (var o = arguments[t], r = 0, l = o.length; r < l; r++, i++) a[i] = o[r];
        return a
    }
    var n = ["onChange", "onClose", "onDayCreate", "onDestroy", "onKeyDown", "onMonthChange", "onOpen", "onParseConfig", "onReady", "onValueUpdate", "onYearChange", "onPreCalendarPosition"],
        a = {
            _disable: [],
            allowInput: !1,
            allowInvalidPreload: !1,
            altFormat: "F j, Y",
            altInput: !1,
            altInputClass: "form-control input",
            animate: "object" == typeof window && -1 === window.navigator.userAgent.indexOf("MSIE"),
            ariaDateFormat: "F j, Y",
            autoFillDefaultTime: !0,
            clickOpens: !0,
            closeOnSelect: !0,
            conjunction: ", ",
            dateFormat: "Y-m-d",
            defaultHour: 12,
            defaultMinute: 0,
            defaultSeconds: 0,
            disable: [],
            disableMobile: !1,
            enableSeconds: !1,
            enableTime: !1,
            errorHandler: function(e) { return "undefined" != typeof console && console.warn(e) },
            getWeek: function(e) {
                var t = new Date(e.getTime());
                t.setHours(0, 0, 0, 0), t.setDate(t.getDate() + 3 - (t.getDay() + 6) % 7);
                var n = new Date(t.getFullYear(), 0, 4);
                return 1 + Math.round(((t.getTime() - n.getTime()) / 864e5 - 3 + (n.getDay() + 6) % 7) / 7)
            },
            hourIncrement: 1,
            ignoredFocusElements: [],
            inline: !1,
            locale: "default",
            minuteIncrement: 5,
            mode: "single",
            monthSelectorType: "dropdown",
            nextArrow: "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 17 17'><g></g><path d='M13.207 8.472l-7.854 7.854-0.707-0.707 7.146-7.146-7.146-7.148 0.707-0.707 7.854 7.854z' /></svg>",
            noCalendar: !1,
            now: new Date,
            onChange: [],
            onClose: [],
            onDayCreate: [],
            onDestroy: [],
            onKeyDown: [],
            onMonthChange: [],
            onOpen: [],
            onParseConfig: [],
            onReady: [],
            onValueUpdate: [],
            onYearChange: [],
            onPreCalendarPosition: [],
            plugins: [],
            position: "auto",
            positionElement: void 0,
            prevArrow: "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 17 17'><g></g><path d='M5.207 8.471l7.146 7.147-0.707 0.707-7.853-7.854 7.854-7.853 0.707 0.707-7.147 7.146z' /></svg>",
            shorthandCurrentMonth: !1,
            showMonths: 1,
            static: !1,
            time_24hr: !1,
            weekNumbers: !1,
            wrap: !1
        },
        i = {
            weekdays: { shorthand: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"], longhand: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"] },
            months: { shorthand: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], longhand: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"] },
            daysInMonth: [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
            firstDayOfWeek: 0,
            ordinal: function(e) {
                var t = e % 100;
                if (t > 3 && t < 21) return "th";
                switch (t % 10) {
                    case 1:
                        return "st";
                    case 2:
                        return "nd";
                    case 3:
                        return "rd";
                    default:
                        return "th"
                }
            },
            rangeSeparator: " to ",
            weekAbbreviation: "Wk",
            scrollTitle: "Scroll to increment",
            toggleTitle: "Click to toggle",
            amPM: ["AM", "PM"],
            yearAriaLabel: "Year",
            monthAriaLabel: "Month",
            hourAriaLabel: "Hour",
            minuteAriaLabel: "Minute",
            time_24hr: !1
        },
        o = function(e, t) { return void 0 === t && (t = 2), ("000" + e).slice(-1 * t) },
        r = function(e) { return !0 === e ? 1 : 0 };

    function l(e, t) {
        var n;
        return function() {
            var a = this;
            clearTimeout(n), n = setTimeout((function() { return e.apply(a, arguments) }), t)
        }
    }
    var c = function(e) { return e instanceof Array ? e : [e] };

    function d(e, t, n) {
        if (!0 === n) return e.classList.add(t);
        e.classList.remove(t)
    }

    function s(e, t, n) { var a = window.document.createElement(e); return t = t || "", n = n || "", a.className = t, void 0 !== n && (a.textContent = n), a }

    function u(e) { for (; e.firstChild;) e.removeChild(e.firstChild) }

    function f(e, t) { return t(e) ? e : e.parentNode ? f(e.parentNode, t) : void 0 }

    function m(e, t) {
        var n = s("div", "numInputWrapper"),
            a = s("input", "numInput " + e),
            i = s("span", "arrowUp"),
            o = s("span", "arrowDown");
        if (-1 === navigator.userAgent.indexOf("MSIE 9.0") ? a.type = "number" : (a.type = "text", a.pattern = "\\d*"), void 0 !== t)
            for (var r in t) a.setAttribute(r, t[r]);
        return n.appendChild(a), n.appendChild(i), n.appendChild(o), n
    }

    function g(e) { try { return "function" == typeof e.composedPath ? e.composedPath()[0] : e.target } catch (t) { return e.target } }
    var p = function() {},
        h = function(e, t, n) { return n.months[t ? "shorthand" : "longhand"][e] },
        v = {
            D: p,
            F: function(e, t, n) { e.setMonth(n.months.longhand.indexOf(t)) },
            G: function(e, t) { e.setHours(parseFloat(t)) },
            H: function(e, t) { e.setHours(parseFloat(t)) },
            J: function(e, t) { e.setDate(parseFloat(t)) },
            K: function(e, t, n) { e.setHours(e.getHours() % 12 + 12 * r(new RegExp(n.amPM[1], "i").test(t))) },
            M: function(e, t, n) { e.setMonth(n.months.shorthand.indexOf(t)) },
            S: function(e, t) { e.setSeconds(parseFloat(t)) },
            U: function(e, t) { return new Date(1e3 * parseFloat(t)) },
            W: function(e, t, n) {
                var a = parseInt(t),
                    i = new Date(e.getFullYear(), 0, 2 + 7 * (a - 1), 0, 0, 0, 0);
                return i.setDate(i.getDate() - i.getDay() + n.firstDayOfWeek), i
            },
            Y: function(e, t) { e.setFullYear(parseFloat(t)) },
            Z: function(e, t) { return new Date(t) },
            d: function(e, t) { e.setDate(parseFloat(t)) },
            h: function(e, t) { e.setHours(parseFloat(t)) },
            i: function(e, t) { e.setMinutes(parseFloat(t)) },
            j: function(e, t) { e.setDate(parseFloat(t)) },
            l: p,
            m: function(e, t) { e.setMonth(parseFloat(t) - 1) },
            n: function(e, t) { e.setMonth(parseFloat(t) - 1) },
            s: function(e, t) { e.setSeconds(parseFloat(t)) },
            u: function(e, t) { return new Date(parseFloat(t)) },
            w: p,
            y: function(e, t) { e.setFullYear(2e3 + parseFloat(t)) }
        },
        D = { D: "(\\w+)", F: "(\\w+)", G: "(\\d\\d|\\d)", H: "(\\d\\d|\\d)", J: "(\\d\\d|\\d)\\w+", K: "", M: "(\\w+)", S: "(\\d\\d|\\d)", U: "(.+)", W: "(\\d\\d|\\d)", Y: "(\\d{4})", Z: "(.+)", d: "(\\d\\d|\\d)", h: "(\\d\\d|\\d)", i: "(\\d\\d|\\d)", j: "(\\d\\d|\\d)", l: "(\\w+)", m: "(\\d\\d|\\d)", n: "(\\d\\d|\\d)", s: "(\\d\\d|\\d)", u: "(.+)", w: "(\\d\\d|\\d)", y: "(\\d{2})" },
        w = { Z: function(e) { return e.toISOString() }, D: function(e, t, n) { return t.weekdays.shorthand[w.w(e, t, n)] }, F: function(e, t, n) { return h(w.n(e, t, n) - 1, !1, t) }, G: function(e, t, n) { return o(w.h(e, t, n)) }, H: function(e) { return o(e.getHours()) }, J: function(e, t) { return void 0 !== t.ordinal ? e.getDate() + t.ordinal(e.getDate()) : e.getDate() }, K: function(e, t) { return t.amPM[r(e.getHours() > 11)] }, M: function(e, t) { return h(e.getMonth(), !0, t) }, S: function(e) { return o(e.getSeconds()) }, U: function(e) { return e.getTime() / 1e3 }, W: function(e, t, n) { return n.getWeek(e) }, Y: function(e) { return o(e.getFullYear(), 4) }, d: function(e) { return o(e.getDate()) }, h: function(e) { return e.getHours() % 12 ? e.getHours() % 12 : 12 }, i: function(e) { return o(e.getMinutes()) }, j: function(e) { return e.getDate() }, l: function(e, t) { return t.weekdays.longhand[e.getDay()] }, m: function(e) { return o(e.getMonth() + 1) }, n: function(e) { return e.getMonth() + 1 }, s: function(e) { return e.getSeconds() }, u: function(e) { return e.getTime() }, w: function(e) { return e.getDay() }, y: function(e) { return String(e.getFullYear()).substring(2) } },
        b = function(e) {
            var t = e.config,
                n = void 0 === t ? a : t,
                o = e.l10n,
                r = void 0 === o ? i : o,
                l = e.isMobile,
                c = void 0 !== l && l;
            return function(e, t, a) { var i = a || r; return void 0 === n.formatDate || c ? t.split("").map((function(t, a, o) { return w[t] && "\\" !== o[a - 1] ? w[t](e, i, n) : "\\" !== t ? t : "" })).join("") : n.formatDate(e, t, i) }
        },
        C = function(e) {
            var t = e.config,
                n = void 0 === t ? a : t,
                o = e.l10n,
                r = void 0 === o ? i : o;
            return function(e, t, i, o) {
                if (0 === e || e) {
                    var l, c = o || r,
                        d = e;
                    if (e instanceof Date) l = new Date(e.getTime());
                    else if ("string" != typeof e && void 0 !== e.toFixed) l = new Date(e);
                    else if ("string" == typeof e) {
                        var s = t || (n || a).dateFormat,
                            u = String(e).trim();
                        if ("today" === u) l = new Date, i = !0;
                        else if (/Z$/.test(u) || /GMT$/.test(u)) l = new Date(e);
                        else if (n && n.parseDate) l = n.parseDate(e, s);
                        else {
                            l = n && n.noCalendar ? new Date((new Date).setHours(0, 0, 0, 0)) : new Date((new Date).getFullYear(), 0, 1, 0, 0, 0, 0);
                            for (var f = void 0, m = [], g = 0, p = 0, h = ""; g < s.length; g++) {
                                var w = s[g],
                                    b = "\\" === w,
                                    C = "\\" === s[g - 1] || b;
                                if (D[w] && !C) {
                                    h += D[w];
                                    var M = new RegExp(h).exec(e);
                                    M && (f = !0) && m["Y" !== w ? "push" : "unshift"]({ fn: v[w], val: M[++p] })
                                } else b || (h += ".");
                                m.forEach((function(e) {
                                    var t = e.fn,
                                        n = e.val;
                                    return l = t(l, n, c) || l
                                }))
                            }
                            l = f ? l : void 0
                        }
                    }
                    if (l instanceof Date && !isNaN(l.getTime())) return !0 === i && l.setHours(0, 0, 0, 0), l;
                    n.errorHandler(new Error("Invalid date provided: " + d))
                }
            }
        };

    function M(e, t, n) { return void 0 === n && (n = !0), !1 !== n ? new Date(e.getTime()).setHours(0, 0, 0, 0) - new Date(t.getTime()).setHours(0, 0, 0, 0) : e.getTime() - t.getTime() }
    var y = 864e5;

    function x(e) {
        var t = e.defaultHour,
            n = e.defaultMinute,
            a = e.defaultSeconds;
        if (void 0 !== e.minDate) {
            var i = e.minDate.getHours(),
                o = e.minDate.getMinutes(),
                r = e.minDate.getSeconds();
            t < i && (t = i), t === i && n < o && (n = o), t === i && n === o && a < r && (a = e.minDate.getSeconds())
        }
        if (void 0 !== e.maxDate) {
            var l = e.maxDate.getHours(),
                c = e.maxDate.getMinutes();
            (t = Math.min(t, l)) === l && (n = Math.min(c, n)), t === l && n === c && (a = e.maxDate.getSeconds())
        }
        return { hours: t, minutes: n, seconds: a }
    }
    "function" != typeof Object.assign && (Object.assign = function(e) {
        for (var t = [], n = 1; n < arguments.length; n++) t[n - 1] = arguments[n];
        if (!e) throw TypeError("Cannot convert undefined or null to object");
        for (var a = function(t) { t && Object.keys(t).forEach((function(n) { return e[n] = t[n] })) }, i = 0, o = t; i < o.length; i++) {
            var r = o[i];
            a(r)
        }
        return e
    });

    function E(p, v) {
        var w = { config: e(e({}, a), T.defaultConfig), l10n: i };

        function E(e) { return e.bind(w) }

        function k() {
            var e = w.config;
            !1 === e.weekNumbers && 1 === e.showMonths || !0 !== e.noCalendar && window.requestAnimationFrame((function() {
                if (void 0 !== w.calendarContainer && (w.calendarContainer.style.visibility = "hidden", w.calendarContainer.style.display = "block"), void 0 !== w.daysContainer) {
                    var t = (w.days.offsetWidth + 1) * e.showMonths;
                    w.daysContainer.style.width = t + "px", w.calendarContainer.style.width = t + (void 0 !== w.weekWrapper ? w.weekWrapper.offsetWidth : 0) + "px", w.calendarContainer.style.removeProperty("visibility"), w.calendarContainer.style.removeProperty("display")
                }
            }))
        }

        function I(e) {
            if (0 === w.selectedDates.length) {
                var t = void 0 === w.config.minDate || M(new Date, w.config.minDate) >= 0 ? new Date : new Date(w.config.minDate.getTime()),
                    n = x(w.config);
                t.setHours(n.hours, n.minutes, n.seconds, t.getMilliseconds()), w.selectedDates = [t], w.latestSelectedDateObj = t
            }
            void 0 !== e && "blur" !== e.type && function(e) {
                e.preventDefault();
                var t = "keydown" === e.type,
                    n = g(e),
                    a = n;
                void 0 !== w.amPM && n === w.amPM && (w.amPM.textContent = w.l10n.amPM[r(w.amPM.textContent === w.l10n.amPM[0])]);
                var i = parseFloat(a.getAttribute("min")),
                    l = parseFloat(a.getAttribute("max")),
                    c = parseFloat(a.getAttribute("step")),
                    d = parseInt(a.value, 10),
                    s = e.delta || (t ? 38 === e.which ? 1 : -1 : 0),
                    u = d + c * s;
                if (void 0 !== a.value && 2 === a.value.length) {
                    var f = a === w.hourElement,
                        m = a === w.minuteElement;
                    u < i ? (u = l + u + r(!f) + (r(f) && r(!w.amPM)), m && j(void 0, -1, w.hourElement)) : u > l && (u = a === w.hourElement ? u - l - r(!w.amPM) : i, m && j(void 0, 1, w.hourElement)), w.amPM && f && (1 === c ? u + d === 23 : Math.abs(u - d) > c) && (w.amPM.textContent = w.l10n.amPM[r(w.amPM.textContent === w.l10n.amPM[0])]), a.value = o(u)
                }
            }(e);
            var a = w._input.value;
            S(), be(), w._input.value !== a && w._debouncedChange()
        }

        function S() {
            if (void 0 !== w.hourElement && void 0 !== w.minuteElement) {
                var e, t, n = (parseInt(w.hourElement.value.slice(-2), 10) || 0) % 24,
                    a = (parseInt(w.minuteElement.value, 10) || 0) % 60,
                    i = void 0 !== w.secondElement ? (parseInt(w.secondElement.value, 10) || 0) % 60 : 0;
                void 0 !== w.amPM && (e = n, t = w.amPM.textContent, n = e % 12 + 12 * r(t === w.l10n.amPM[1]));
                var o = void 0 !== w.config.minTime || w.config.minDate && w.minDateHasTime && w.latestSelectedDateObj && 0 === M(w.latestSelectedDateObj, w.config.minDate, !0);
                if (void 0 !== w.config.maxTime || w.config.maxDate && w.maxDateHasTime && w.latestSelectedDateObj && 0 === M(w.latestSelectedDateObj, w.config.maxDate, !0)) {
                    var l = void 0 !== w.config.maxTime ? w.config.maxTime : w.config.maxDate;
                    (n = Math.min(n, l.getHours())) === l.getHours() && (a = Math.min(a, l.getMinutes())), a === l.getMinutes() && (i = Math.min(i, l.getSeconds()))
                }
                if (o) {
                    var c = void 0 !== w.config.minTime ? w.config.minTime : w.config.minDate;
                    (n = Math.max(n, c.getHours())) === c.getHours() && a < c.getMinutes() && (a = c.getMinutes()), a === c.getMinutes() && (i = Math.max(i, c.getSeconds()))
                }
                O(n, a, i)
            }
        }

        function _(e) {
            var t = e || w.latestSelectedDateObj;
            t && O(t.getHours(), t.getMinutes(), t.getSeconds())
        }

        function O(e, t, n) { void 0 !== w.latestSelectedDateObj && w.latestSelectedDateObj.setHours(e % 24, t, n || 0, 0), w.hourElement && w.minuteElement && !w.isMobile && (w.hourElement.value = o(w.config.time_24hr ? e : (12 + e) % 12 + 12 * r(e % 12 == 0)), w.minuteElement.value = o(t), void 0 !== w.amPM && (w.amPM.textContent = w.l10n.amPM[r(e >= 12)]), void 0 !== w.secondElement && (w.secondElement.value = o(n))) }

        function F(e) {
            var t = g(e),
                n = parseInt(t.value) + (e.delta || 0);
            (n / 1e3 > 1 || "Enter" === e.key && !/[^\d]/.test(n.toString())) && Q(n)
        }

        function A(e, t, n, a) { return t instanceof Array ? t.forEach((function(t) { return A(e, t, n, a) })) : e instanceof Array ? e.forEach((function(e) { return A(e, t, n, a) })) : (e.addEventListener(t, n, a), void w._handlers.push({ remove: function() { return e.removeEventListener(t, n) } })) }

        function N() { pe("onChange") }

        function P(e, t) {
            var n = void 0 !== e ? w.parseDate(e) : w.latestSelectedDateObj || (w.config.minDate && w.config.minDate > w.now ? w.config.minDate : w.config.maxDate && w.config.maxDate < w.now ? w.config.maxDate : w.now),
                a = w.currentYear,
                i = w.currentMonth;
            try { void 0 !== n && (w.currentYear = n.getFullYear(), w.currentMonth = n.getMonth()) } catch (e) { e.message = "Invalid date supplied: " + n, w.config.errorHandler(e) }
            t && w.currentYear !== a && (pe("onYearChange"), K()), !t || w.currentYear === a && w.currentMonth === i || pe("onMonthChange"), w.redraw()
        }

        function Y(e) { var t = g(e);~t.className.indexOf("arrow") && j(e, t.classList.contains("arrowUp") ? 1 : -1) }

        function j(e, t, n) {
            var a = e && g(e),
                i = n || a && a.parentNode && a.parentNode.firstChild,
                o = he("increment");
            o.delta = t, i && i.dispatchEvent(o)
        }

        function H(e, t, n, a) {
            var i = X(t, !0),
                o = s("span", "flatpickr-day " + e, t.getDate().toString());
            return o.dateObj = t, o.$i = a, o.setAttribute("aria-label", w.formatDate(t, w.config.ariaDateFormat)), -1 === e.indexOf("hidden") && 0 === M(t, w.now) && (w.todayDateElem = o, o.classList.add("today"), o.setAttribute("aria-current", "date")), i ? (o.tabIndex = -1, ve(t) && (o.classList.add("selected"), w.selectedDateElem = o, "range" === w.config.mode && (d(o, "startRange", w.selectedDates[0] && 0 === M(t, w.selectedDates[0], !0)), d(o, "endRange", w.selectedDates[1] && 0 === M(t, w.selectedDates[1], !0)), "nextMonthDay" === e && o.classList.add("inRange")))) : o.classList.add("flatpickr-disabled"), "range" === w.config.mode && function(e) { return !("range" !== w.config.mode || w.selectedDates.length < 2) && (M(e, w.selectedDates[0]) >= 0 && M(e, w.selectedDates[1]) <= 0) }(t) && !ve(t) && o.classList.add("inRange"), w.weekNumbers && 1 === w.config.showMonths && "prevMonthDay" !== e && n % 7 == 1 && w.weekNumbers.insertAdjacentHTML("beforeend", "<span class='flatpickr-day'>" + w.config.getWeek(t) + "</span>"), pe("onDayCreate", o), o
        }

        function L(e) { e.focus(), "range" === w.config.mode && ae(e) }

        function W(e) {
            for (var t = e > 0 ? 0 : w.config.showMonths - 1, n = e > 0 ? w.config.showMonths : -1, a = t; a != n; a += e)
                for (var i = w.daysContainer.children[a], o = e > 0 ? 0 : i.children.length - 1, r = e > 0 ? i.children.length : -1, l = o; l != r; l += e) { var c = i.children[l]; if (-1 === c.className.indexOf("hidden") && X(c.dateObj)) return c }
        }

        function R(e, t) {
            var n = ee(document.activeElement || document.body),
                a = void 0 !== e ? e : n ? document.activeElement : void 0 !== w.selectedDateElem && ee(w.selectedDateElem) ? w.selectedDateElem : void 0 !== w.todayDateElem && ee(w.todayDateElem) ? w.todayDateElem : W(t > 0 ? 1 : -1);
            void 0 === a ? w._input.focus() : n ? function(e, t) {
                for (var n = -1 === e.className.indexOf("Month") ? e.dateObj.getMonth() : w.currentMonth, a = t > 0 ? w.config.showMonths : -1, i = t > 0 ? 1 : -1, o = n - w.currentMonth; o != a; o += i)
                    for (var r = w.daysContainer.children[o], l = n - w.currentMonth === o ? e.$i + t : t < 0 ? r.children.length - 1 : 0, c = r.children.length, d = l; d >= 0 && d < c && d != (t > 0 ? c : -1); d += i) { var s = r.children[d]; if (-1 === s.className.indexOf("hidden") && X(s.dateObj) && Math.abs(e.$i - d) >= Math.abs(t)) return L(s) }
                w.changeMonth(i), R(W(i), 0)
            }(a, t) : L(a)
        }

        function B(e, t) { for (var n = (new Date(e, t, 1).getDay() - w.l10n.firstDayOfWeek + 7) % 7, a = w.utils.getDaysInMonth((t - 1 + 12) % 12, e), i = w.utils.getDaysInMonth(t, e), o = window.document.createDocumentFragment(), r = w.config.showMonths > 1, l = r ? "prevMonthDay hidden" : "prevMonthDay", c = r ? "nextMonthDay hidden" : "nextMonthDay", d = a + 1 - n, u = 0; d <= a; d++, u++) o.appendChild(H(l, new Date(e, t - 1, d), d, u)); for (d = 1; d <= i; d++, u++) o.appendChild(H("", new Date(e, t, d), d, u)); for (var f = i + 1; f <= 42 - n && (1 === w.config.showMonths || u % 7 != 0); f++, u++) o.appendChild(H(c, new Date(e, t + 1, f % i), f, u)); var m = s("div", "dayContainer"); return m.appendChild(o), m }

        function J() {
            if (void 0 !== w.daysContainer) {
                u(w.daysContainer), w.weekNumbers && u(w.weekNumbers);
                for (var e = document.createDocumentFragment(), t = 0; t < w.config.showMonths; t++) {
                    var n = new Date(w.currentYear, w.currentMonth, 1);
                    n.setMonth(w.currentMonth + t), e.appendChild(B(n.getFullYear(), n.getMonth()))
                }
                w.daysContainer.appendChild(e), w.days = w.daysContainer.firstChild, "range" === w.config.mode && 1 === w.selectedDates.length && ae()
            }
        }

        function K() {
            if (!(w.config.showMonths > 1 || "dropdown" !== w.config.monthSelectorType)) {
                var e = function(e) { return !(void 0 !== w.config.minDate && w.currentYear === w.config.minDate.getFullYear() && e < w.config.minDate.getMonth()) && !(void 0 !== w.config.maxDate && w.currentYear === w.config.maxDate.getFullYear() && e > w.config.maxDate.getMonth()) };
                w.monthsDropdownContainer.tabIndex = -1, w.monthsDropdownContainer.innerHTML = "";
                for (var t = 0; t < 12; t++)
                    if (e(t)) {
                        var n = s("option", "flatpickr-monthDropdown-month");
                        n.value = new Date(w.currentYear, t).getMonth().toString(), n.textContent = h(t, w.config.shorthandCurrentMonth, w.l10n), n.tabIndex = -1, w.currentMonth === t && (n.selected = !0), w.monthsDropdownContainer.appendChild(n)
                    }
            }
        }

        function U() {
            var e, t = s("div", "flatpickr-month"),
                n = window.document.createDocumentFragment();
            w.config.showMonths > 1 || "static" === w.config.monthSelectorType ? e = s("span", "cur-month") : (w.monthsDropdownContainer = s("select", "flatpickr-monthDropdown-months"), w.monthsDropdownContainer.setAttribute("aria-label", w.l10n.monthAriaLabel), A(w.monthsDropdownContainer, "change", (function(e) {
                var t = g(e),
                    n = parseInt(t.value, 10);
                w.changeMonth(n - w.currentMonth), pe("onMonthChange")
            })), K(), e = w.monthsDropdownContainer);
            var a = m("cur-year", { tabindex: "-1" }),
                i = a.getElementsByTagName("input")[0];
            i.setAttribute("aria-label", w.l10n.yearAriaLabel), w.config.minDate && i.setAttribute("min", w.config.minDate.getFullYear().toString()), w.config.maxDate && (i.setAttribute("max", w.config.maxDate.getFullYear().toString()), i.disabled = !!w.config.minDate && w.config.minDate.getFullYear() === w.config.maxDate.getFullYear());
            var o = s("div", "flatpickr-current-month");
            return o.appendChild(e), o.appendChild(a), n.appendChild(o), t.appendChild(n), { container: t, yearElement: i, monthElement: e }
        }

        function q() {
            u(w.monthNav), w.monthNav.appendChild(w.prevMonthNav), w.config.showMonths && (w.yearElements = [], w.monthElements = []);
            for (var e = w.config.showMonths; e--;) {
                var t = U();
                w.yearElements.push(t.yearElement), w.monthElements.push(t.monthElement), w.monthNav.appendChild(t.container)
            }
            w.monthNav.appendChild(w.nextMonthNav)
        }

        function $() {
            w.weekdayContainer ? u(w.weekdayContainer) : w.weekdayContainer = s("div", "flatpickr-weekdays");
            for (var e = w.config.showMonths; e--;) {
                var t = s("div", "flatpickr-weekdaycontainer");
                w.weekdayContainer.appendChild(t)
            }
            return z(), w.weekdayContainer
        }

        function z() {
            if (w.weekdayContainer) {
                var e = w.l10n.firstDayOfWeek,
                    n = t(w.l10n.weekdays.shorthand);
                e > 0 && e < n.length && (n = t(n.splice(e, n.length), n.splice(0, e)));
                for (var a = w.config.showMonths; a--;) w.weekdayContainer.children[a].innerHTML = "\n      <span class='flatpickr-weekday'>\n        " + n.join("</span><span class='flatpickr-weekday'>") + "\n      </span>\n      "
            }
        }

        function G(e, t) {
            void 0 === t && (t = !0);
            var n = t ? e : e - w.currentMonth;
            n < 0 && !0 === w._hidePrevMonthArrow || n > 0 && !0 === w._hideNextMonthArrow || (w.currentMonth += n, (w.currentMonth < 0 || w.currentMonth > 11) && (w.currentYear += w.currentMonth > 11 ? 1 : -1, w.currentMonth = (w.currentMonth + 12) % 12, pe("onYearChange"), K()), J(), pe("onMonthChange"), De())
        }

        function V(e) { return !(!w.config.appendTo || !w.config.appendTo.contains(e)) || w.calendarContainer.contains(e) }

        function Z(e) {
            if (w.isOpen && !w.config.inline) {
                var t = g(e),
                    n = V(t),
                    a = t === w.input || t === w.altInput || w.element.contains(t) || e.path && e.path.indexOf && (~e.path.indexOf(w.input) || ~e.path.indexOf(w.altInput)),
                    i = "blur" === e.type ? a && e.relatedTarget && !V(e.relatedTarget) : !a && !n && !V(e.relatedTarget),
                    o = !w.config.ignoredFocusElements.some((function(e) { return e.contains(t) }));
                i && o && (void 0 !== w.timeContainer && void 0 !== w.minuteElement && void 0 !== w.hourElement && "" !== w.input.value && void 0 !== w.input.value && I(), w.close(), w.config && "range" === w.config.mode && 1 === w.selectedDates.length && (w.clear(!1), w.redraw()))
            }
        }

        function Q(e) {
            if (!(!e || w.config.minDate && e < w.config.minDate.getFullYear() || w.config.maxDate && e > w.config.maxDate.getFullYear())) {
                var t = e,
                    n = w.currentYear !== t;
                w.currentYear = t || w.currentYear, w.config.maxDate && w.currentYear === w.config.maxDate.getFullYear() ? w.currentMonth = Math.min(w.config.maxDate.getMonth(), w.currentMonth) : w.config.minDate && w.currentYear === w.config.minDate.getFullYear() && (w.currentMonth = Math.max(w.config.minDate.getMonth(), w.currentMonth)), n && (w.redraw(), pe("onYearChange"), K())
            }
        }

        function X(e, t) {
            var n;
            void 0 === t && (t = !0);
            var a = w.parseDate(e, void 0, t);
            if (w.config.minDate && a && M(a, w.config.minDate, void 0 !== t ? t : !w.minDateHasTime) < 0 || w.config.maxDate && a && M(a, w.config.maxDate, void 0 !== t ? t : !w.maxDateHasTime) > 0) return !1;
            if (!w.config.enable && 0 === w.config.disable.length) return !0;
            if (void 0 === a) return !1;
            for (var i = !!w.config.enable, o = null !== (n = w.config.enable) && void 0 !== n ? n : w.config.disable, r = 0, l = void 0; r < o.length; r++) { if ("function" == typeof(l = o[r]) && l(a)) return i; if (l instanceof Date && void 0 !== a && l.getTime() === a.getTime()) return i; if ("string" == typeof l) { var c = w.parseDate(l, void 0, !0); return c && c.getTime() === a.getTime() ? i : !i } if ("object" == typeof l && void 0 !== a && l.from && l.to && a.getTime() >= l.from.getTime() && a.getTime() <= l.to.getTime()) return i }
            return !i
        }

        function ee(e) { return void 0 !== w.daysContainer && (-1 === e.className.indexOf("hidden") && -1 === e.className.indexOf("flatpickr-disabled") && w.daysContainer.contains(e)) }

        function te(e) {!(e.target === w._input) || !(w.selectedDates.length > 0 || w._input.value.length > 0) || e.relatedTarget && V(e.relatedTarget) || w.setDate(w._input.value, !0, e.target === w.altInput ? w.config.altFormat : w.config.dateFormat) }

        function ne(e) {
            var t = g(e),
                n = w.config.wrap ? p.contains(t) : t === w._input,
                a = w.config.allowInput,
                i = w.isOpen && (!a || !n),
                o = w.config.inline && n && !a;
            if (13 === e.keyCode && n) {
                if (a) return w.setDate(w._input.value, !0, t === w.altInput ? w.config.altFormat : w.config.dateFormat), t.blur();
                w.open()
            } else if (V(t) || i || o) {
                var r = !!w.timeContainer && w.timeContainer.contains(t);
                switch (e.keyCode) {
                    case 13:
                        r ? (e.preventDefault(), I(), se()) : ue(e);
                        break;
                    case 27:
                        e.preventDefault(), se();
                        break;
                    case 8:
                    case 46:
                        n && !w.config.allowInput && (e.preventDefault(), w.clear());
                        break;
                    case 37:
                    case 39:
                        if (r || n) w.hourElement && w.hourElement.focus();
                        else if (e.preventDefault(), void 0 !== w.daysContainer && (!1 === a || document.activeElement && ee(document.activeElement))) {
                            var l = 39 === e.keyCode ? 1 : -1;
                            e.ctrlKey ? (e.stopPropagation(), G(l), R(W(1), 0)) : R(void 0, l)
                        }
                        break;
                    case 38:
                    case 40:
                        e.preventDefault();
                        var c = 40 === e.keyCode ? 1 : -1;
                        w.daysContainer && void 0 !== t.$i || t === w.input || t === w.altInput ? e.ctrlKey ? (e.stopPropagation(), Q(w.currentYear - c), R(W(1), 0)) : r || R(void 0, 7 * c) : t === w.currentYearElement ? Q(w.currentYear - c) : w.config.enableTime && (!r && w.hourElement && w.hourElement.focus(), I(e), w._debouncedChange());
                        break;
                    case 9:
                        if (r) {
                            var d = [w.hourElement, w.minuteElement, w.secondElement, w.amPM].concat(w.pluginElements).filter((function(e) { return e })),
                                s = d.indexOf(t);
                            if (-1 !== s) {
                                var u = d[s + (e.shiftKey ? -1 : 1)];
                                e.preventDefault(), (u || w._input).focus()
                            }
                        } else !w.config.noCalendar && w.daysContainer && w.daysContainer.contains(t) && e.shiftKey && (e.preventDefault(), w._input.focus())
                }
            }
            if (void 0 !== w.amPM && t === w.amPM) switch (e.key) {
                case w.l10n.amPM[0].charAt(0):
                case w.l10n.amPM[0].charAt(0).toLowerCase():
                    w.amPM.textContent = w.l10n.amPM[0], S(), be();
                    break;
                case w.l10n.amPM[1].charAt(0):
                case w.l10n.amPM[1].charAt(0).toLowerCase():
                    w.amPM.textContent = w.l10n.amPM[1], S(), be()
            }(n || V(t)) && pe("onKeyDown", e)
        }

        function ae(e) {
            if (1 === w.selectedDates.length && (!e || e.classList.contains("flatpickr-day") && !e.classList.contains("flatpickr-disabled"))) {
                for (var t = e ? e.dateObj.getTime() : w.days.firstElementChild.dateObj.getTime(), n = w.parseDate(w.selectedDates[0], void 0, !0).getTime(), a = Math.min(t, w.selectedDates[0].getTime()), i = Math.max(t, w.selectedDates[0].getTime()), o = !1, r = 0, l = 0, c = a; c < i; c += y) X(new Date(c), !0) || (o = o || c > a && c < i, c < n && (!r || c > r) ? r = c : c > n && (!l || c < l) && (l = c));
                for (var d = 0; d < w.config.showMonths; d++)
                    for (var s = w.daysContainer.children[d], u = function(a, i) {
                            var c, d, u, f = s.children[a],
                                m = f.dateObj.getTime(),
                                g = r > 0 && m < r || l > 0 && m > l;
                            return g ? (f.classList.add("notAllowed"), ["inRange", "startRange", "endRange"].forEach((function(e) { f.classList.remove(e) })), "continue") : o && !g ? "continue" : (["startRange", "inRange", "endRange", "notAllowed"].forEach((function(e) { f.classList.remove(e) })), void(void 0 !== e && (e.classList.add(t <= w.selectedDates[0].getTime() ? "startRange" : "endRange"), n < t && m === n ? f.classList.add("startRange") : n > t && m === n && f.classList.add("endRange"), m >= r && (0 === l || m <= l) && (d = n, u = t, (c = m) > Math.min(d, u) && c < Math.max(d, u)) && f.classList.add("inRange"))))
                        }, f = 0, m = s.children.length; f < m; f++) u(f)
            }
        }

        function ie() {!w.isOpen || w.config.static || w.config.inline || ce() }

        function oe(e) {
            return function(t) {
                var n = w.config["_" + e + "Date"] = w.parseDate(t, w.config.dateFormat),
                    a = w.config["_" + ("min" === e ? "max" : "min") + "Date"];
                void 0 !== n && (w["min" === e ? "minDateHasTime" : "maxDateHasTime"] = n.getHours() > 0 || n.getMinutes() > 0 || n.getSeconds() > 0), w.selectedDates && (w.selectedDates = w.selectedDates.filter((function(e) { return X(e) })), w.selectedDates.length || "min" !== e || _(n), be()), w.daysContainer && (de(), void 0 !== n ? w.currentYearElement[e] = n.getFullYear().toString() : w.currentYearElement.removeAttribute(e), w.currentYearElement.disabled = !!a && void 0 !== n && a.getFullYear() === n.getFullYear())
            }
        }

        function re() { return w.config.wrap ? p.querySelector("[data-input]") : p }

        function le() { "object" != typeof w.config.locale && void 0 === T.l10ns[w.config.locale] && w.config.errorHandler(new Error("flatpickr: invalid locale " + w.config.locale)), w.l10n = e(e({}, T.l10ns.default), "object" == typeof w.config.locale ? w.config.locale : "default" !== w.config.locale ? T.l10ns[w.config.locale] : void 0), D.K = "(" + w.l10n.amPM[0] + "|" + w.l10n.amPM[1] + "|" + w.l10n.amPM[0].toLowerCase() + "|" + w.l10n.amPM[1].toLowerCase() + ")", void 0 === e(e({}, v), JSON.parse(JSON.stringify(p.dataset || {}))).time_24hr && void 0 === T.defaultConfig.time_24hr && (w.config.time_24hr = w.l10n.time_24hr), w.formatDate = b(w), w.parseDate = C({ config: w.config, l10n: w.l10n }) }

        function ce(e) {
            if ("function" != typeof w.config.position) {
                if (void 0 !== w.calendarContainer) {
                    pe("onPreCalendarPosition");
                    var t = e || w._positionElement,
                        n = Array.prototype.reduce.call(w.calendarContainer.children, (function(e, t) { return e + t.offsetHeight }), 0),
                        a = w.calendarContainer.offsetWidth,
                        i = w.config.position.split(" "),
                        o = i[0],
                        r = i.length > 1 ? i[1] : null,
                        l = t.getBoundingClientRect(),
                        c = window.innerHeight - l.bottom,
                        s = "above" === o || "below" !== o && c < n && l.top > n,
                        u = window.pageYOffset + l.top + (s ? -n - 2 : t.offsetHeight + 2);
                    if (d(w.calendarContainer, "arrowTop", !s), d(w.calendarContainer, "arrowBottom", s), !w.config.inline) {
                        var f = window.pageXOffset + l.left,
                            m = !1,
                            g = !1;
                        "center" === r ? (f -= (a - l.width) / 2, m = !0) : "right" === r && (f -= a - l.width, g = !0), d(w.calendarContainer, "arrowLeft", !m && !g), d(w.calendarContainer, "arrowCenter", m), d(w.calendarContainer, "arrowRight", g);
                        var p = window.document.body.offsetWidth - (window.pageXOffset + l.right),
                            h = f + a > window.document.body.offsetWidth,
                            v = p + a > window.document.body.offsetWidth;
                        if (d(w.calendarContainer, "rightMost", h), !w.config.static)
                            if (w.calendarContainer.style.top = u + "px", h)
                                if (v) {
                                    var D = function() {
                                        for (var e = null, t = 0; t < document.styleSheets.length; t++) {
                                            var n = document.styleSheets[t];
                                            try { n.cssRules } catch (e) { continue }
                                            e = n;
                                            break
                                        }
                                        return null != e ? e : (a = document.createElement("style"), document.head.appendChild(a), a.sheet);
                                        var a
                                    }();
                                    if (void 0 === D) return;
                                    var b = window.document.body.offsetWidth,
                                        C = Math.max(0, b / 2 - a / 2),
                                        M = D.cssRules.length,
                                        y = "{left:" + l.left + "px;right:auto;}";
                                    d(w.calendarContainer, "rightMost", !1), d(w.calendarContainer, "centerMost", !0), D.insertRule(".flatpickr-calendar.centerMost:before,.flatpickr-calendar.centerMost:after" + y, M), w.calendarContainer.style.left = C + "px", w.calendarContainer.style.right = "auto"
                                } else w.calendarContainer.style.left = "auto", w.calendarContainer.style.right = p + "px";
                        else w.calendarContainer.style.left = f + "px", w.calendarContainer.style.right = "auto"
                    }
                }
            } else w.config.position(w, e)
        }

        function de() { w.config.noCalendar || w.isMobile || (K(), De(), J()) }

        function se() { w._input.focus(), -1 !== window.navigator.userAgent.indexOf("MSIE") || void 0 !== navigator.msMaxTouchPoints ? setTimeout(w.close, 0) : w.close() }

        function ue(e) {
            e.preventDefault(), e.stopPropagation();
            var t = f(g(e), (function(e) { return e.classList && e.classList.contains("flatpickr-day") && !e.classList.contains("flatpickr-disabled") && !e.classList.contains("notAllowed") }));
            if (void 0 !== t) {
                var n = t,
                    a = w.latestSelectedDateObj = new Date(n.dateObj.getTime()),
                    i = (a.getMonth() < w.currentMonth || a.getMonth() > w.currentMonth + w.config.showMonths - 1) && "range" !== w.config.mode;
                if (w.selectedDateElem = n, "single" === w.config.mode) w.selectedDates = [a];
                else if ("multiple" === w.config.mode) {
                    var o = ve(a);
                    o ? w.selectedDates.splice(parseInt(o), 1) : w.selectedDates.push(a)
                } else "range" === w.config.mode && (2 === w.selectedDates.length && w.clear(!1, !1), w.latestSelectedDateObj = a, w.selectedDates.push(a), 0 !== M(a, w.selectedDates[0], !0) && w.selectedDates.sort((function(e, t) { return e.getTime() - t.getTime() })));
                if (S(), i) {
                    var r = w.currentYear !== a.getFullYear();
                    w.currentYear = a.getFullYear(), w.currentMonth = a.getMonth(), r && (pe("onYearChange"), K()), pe("onMonthChange")
                }
                if (De(), J(), be(), i || "range" === w.config.mode || 1 !== w.config.showMonths ? void 0 !== w.selectedDateElem && void 0 === w.hourElement && w.selectedDateElem && w.selectedDateElem.focus() : L(n), void 0 !== w.hourElement && void 0 !== w.hourElement && w.hourElement.focus(), w.config.closeOnSelect) {
                    var l = "single" === w.config.mode && !w.config.enableTime,
                        c = "range" === w.config.mode && 2 === w.selectedDates.length && !w.config.enableTime;
                    (l || c) && se()
                }
                N()
            }
        }
        w.parseDate = C({ config: w.config, l10n: w.l10n }), w._handlers = [], w.pluginElements = [], w.loadedPlugins = [], w._bind = A, w._setHoursFromDate = _, w._positionCalendar = ce, w.changeMonth = G, w.changeYear = Q, w.clear = function(e, t) {
            void 0 === e && (e = !0);
            void 0 === t && (t = !0);
            w.input.value = "", void 0 !== w.altInput && (w.altInput.value = "");
            void 0 !== w.mobileInput && (w.mobileInput.value = "");
            w.selectedDates = [], w.latestSelectedDateObj = void 0, !0 === t && (w.currentYear = w._initialDate.getFullYear(), w.currentMonth = w._initialDate.getMonth());
            if (!0 === w.config.enableTime) {
                var n = x(w.config),
                    a = n.hours,
                    i = n.minutes,
                    o = n.seconds;
                O(a, i, o)
            }
            w.redraw(), e && pe("onChange")
        }, w.close = function() {
            w.isOpen = !1, w.isMobile || (void 0 !== w.calendarContainer && w.calendarContainer.classList.remove("open"), void 0 !== w._input && w._input.classList.remove("active"));
            pe("onClose")
        }, w._createElement = s, w.destroy = function() {
            void 0 !== w.config && pe("onDestroy");
            for (var e = w._handlers.length; e--;) w._handlers[e].remove();
            if (w._handlers = [], w.mobileInput) w.mobileInput.parentNode && w.mobileInput.parentNode.removeChild(w.mobileInput), w.mobileInput = void 0;
            else if (w.calendarContainer && w.calendarContainer.parentNode)
                if (w.config.static && w.calendarContainer.parentNode) {
                    var t = w.calendarContainer.parentNode;
                    if (t.lastChild && t.removeChild(t.lastChild), t.parentNode) {
                        for (; t.firstChild;) t.parentNode.insertBefore(t.firstChild, t);
                        t.parentNode.removeChild(t)
                    }
                } else w.calendarContainer.parentNode.removeChild(w.calendarContainer);
            w.altInput && (w.input.type = "text", w.altInput.parentNode && w.altInput.parentNode.removeChild(w.altInput), delete w.altInput);
            w.input && (w.input.type = w.input._type, w.input.classList.remove("flatpickr-input"), w.input.removeAttribute("readonly"));
            ["_showTimeInput", "latestSelectedDateObj", "_hideNextMonthArrow", "_hidePrevMonthArrow", "__hideNextMonthArrow", "__hidePrevMonthArrow", "isMobile", "isOpen", "selectedDateElem", "minDateHasTime", "maxDateHasTime", "days", "daysContainer", "_input", "_positionElement", "innerContainer", "rContainer", "monthNav", "todayDateElem", "calendarContainer", "weekdayContainer", "prevMonthNav", "nextMonthNav", "monthsDropdownContainer", "currentMonthElement", "currentYearElement", "navigationCurrentMonth", "selectedDateElem", "config"].forEach((function(e) { try { delete w[e] } catch (e) {} }))
        }, w.isEnabled = X, w.jumpToDate = P, w.open = function(e, t) {
            void 0 === t && (t = w._positionElement);
            if (!0 === w.isMobile) {
                if (e) {
                    e.preventDefault();
                    var n = g(e);
                    n && n.blur()
                }
                return void 0 !== w.mobileInput && (w.mobileInput.focus(), w.mobileInput.click()), void pe("onOpen")
            }
            if (w._input.disabled || w.config.inline) return;
            var a = w.isOpen;
            w.isOpen = !0, a || (w.calendarContainer.classList.add("open"), w._input.classList.add("active"), pe("onOpen"), ce(t));
            !0 === w.config.enableTime && !0 === w.config.noCalendar && (!1 !== w.config.allowInput || void 0 !== e && w.timeContainer.contains(e.relatedTarget) || setTimeout((function() { return w.hourElement.select() }), 50))
        }, w.redraw = de, w.set = function(e, t) {
            if (null !== e && "object" == typeof e)
                for (var a in Object.assign(w.config, e), e) void 0 !== fe[a] && fe[a].forEach((function(e) { return e() }));
            else w.config[e] = t, void 0 !== fe[e] ? fe[e].forEach((function(e) { return e() })) : n.indexOf(e) > -1 && (w.config[e] = c(t));
            w.redraw(), be(!0)
        }, w.setDate = function(e, t, n) {
            void 0 === t && (t = !1);
            void 0 === n && (n = w.config.dateFormat);
            if (0 !== e && !e || e instanceof Array && 0 === e.length) return w.clear(t);
            me(e, n), w.latestSelectedDateObj = w.selectedDates[w.selectedDates.length - 1], w.redraw(), P(void 0, t), _(), 0 === w.selectedDates.length && w.clear(!1);
            be(t), t && pe("onChange")
        }, w.toggle = function(e) {
            if (!0 === w.isOpen) return w.close();
            w.open(e)
        };
        var fe = { locale: [le, z], showMonths: [q, k, $], minDate: [P], maxDate: [P], clickOpens: [function() {!0 === w.config.clickOpens ? (A(w._input, "focus", w.open), A(w._input, "click", w.open)) : (w._input.removeEventListener("focus", w.open), w._input.removeEventListener("click", w.open)) }] };

        function me(e, t) {
            var n = [];
            if (e instanceof Array) n = e.map((function(e) { return w.parseDate(e, t) }));
            else if (e instanceof Date || "number" == typeof e) n = [w.parseDate(e, t)];
            else if ("string" == typeof e) switch (w.config.mode) {
                case "single":
                case "time":
                    n = [w.parseDate(e, t)];
                    break;
                case "multiple":
                    n = e.split(w.config.conjunction).map((function(e) { return w.parseDate(e, t) }));
                    break;
                case "range":
                    n = e.split(w.l10n.rangeSeparator).map((function(e) { return w.parseDate(e, t) }))
            } else w.config.errorHandler(new Error("Invalid date supplied: " + JSON.stringify(e)));
            w.selectedDates = w.config.allowInvalidPreload ? n : n.filter((function(e) { return e instanceof Date && X(e, !1) })), "range" === w.config.mode && w.selectedDates.sort((function(e, t) { return e.getTime() - t.getTime() }))
        }

        function ge(e) { return e.slice().map((function(e) { return "string" == typeof e || "number" == typeof e || e instanceof Date ? w.parseDate(e, void 0, !0) : e && "object" == typeof e && e.from && e.to ? { from: w.parseDate(e.from, void 0), to: w.parseDate(e.to, void 0) } : e })).filter((function(e) { return e })) }

        function pe(e, t) {
            if (void 0 !== w.config) {
                var n = w.config[e];
                if (void 0 !== n && n.length > 0)
                    for (var a = 0; n[a] && a < n.length; a++) n[a](w.selectedDates, w.input.value, w, t);
                "onChange" === e && (w.input.dispatchEvent(he("change")), w.input.dispatchEvent(he("input")))
            }
        }

        function he(e) { var t = document.createEvent("Event"); return t.initEvent(e, !0, !0), t }

        function ve(e) {
            for (var t = 0; t < w.selectedDates.length; t++)
                if (0 === M(w.selectedDates[t], e)) return "" + t;
            return !1
        }

        function De() {
            w.config.noCalendar || w.isMobile || !w.monthNav || (w.yearElements.forEach((function(e, t) {
                var n = new Date(w.currentYear, w.currentMonth, 1);
                n.setMonth(w.currentMonth + t), w.config.showMonths > 1 || "static" === w.config.monthSelectorType ? w.monthElements[t].textContent = h(n.getMonth(), w.config.shorthandCurrentMonth, w.l10n) + " " : w.monthsDropdownContainer.value = n.getMonth().toString(), e.value = n.getFullYear().toString()
            })), w._hidePrevMonthArrow = void 0 !== w.config.minDate && (w.currentYear === w.config.minDate.getFullYear() ? w.currentMonth <= w.config.minDate.getMonth() : w.currentYear < w.config.minDate.getFullYear()), w._hideNextMonthArrow = void 0 !== w.config.maxDate && (w.currentYear === w.config.maxDate.getFullYear() ? w.currentMonth + 1 > w.config.maxDate.getMonth() : w.currentYear > w.config.maxDate.getFullYear()))
        }

        function we(e) { return w.selectedDates.map((function(t) { return w.formatDate(t, e) })).filter((function(e, t, n) { return "range" !== w.config.mode || w.config.enableTime || n.indexOf(e) === t })).join("range" !== w.config.mode ? w.config.conjunction : w.l10n.rangeSeparator) }

        function be(e) { void 0 === e && (e = !0), void 0 !== w.mobileInput && w.mobileFormatStr && (w.mobileInput.value = void 0 !== w.latestSelectedDateObj ? w.formatDate(w.latestSelectedDateObj, w.mobileFormatStr) : ""), w.input.value = we(w.config.dateFormat), void 0 !== w.altInput && (w.altInput.value = we(w.config.altFormat)), !1 !== e && pe("onValueUpdate") }

        function Ce(e) {
            var t = g(e),
                n = w.prevMonthNav.contains(t),
                a = w.nextMonthNav.contains(t);
            n || a ? G(n ? -1 : 1) : w.yearElements.indexOf(t) >= 0 ? t.select() : t.classList.contains("arrowUp") ? w.changeYear(w.currentYear + 1) : t.classList.contains("arrowDown") && w.changeYear(w.currentYear - 1)
        }
        return function() {
            w.element = w.input = p, w.isOpen = !1,
                function() {
                    var t = ["wrap", "weekNumbers", "allowInput", "allowInvalidPreload", "clickOpens", "time_24hr", "enableTime", "noCalendar", "altInput", "shorthandCurrentMonth", "inline", "static", "enableSeconds", "disableMobile"],
                        i = e(e({}, JSON.parse(JSON.stringify(p.dataset || {}))), v),
                        o = {};
                    w.config.parseDate = i.parseDate, w.config.formatDate = i.formatDate, Object.defineProperty(w.config, "enable", { get: function() { return w.config._enable }, set: function(e) { w.config._enable = ge(e) } }), Object.defineProperty(w.config, "disable", { get: function() { return w.config._disable }, set: function(e) { w.config._disable = ge(e) } });
                    var r = "time" === i.mode;
                    if (!i.dateFormat && (i.enableTime || r)) {
                        var l = T.defaultConfig.dateFormat || a.dateFormat;
                        o.dateFormat = i.noCalendar || r ? "H:i" + (i.enableSeconds ? ":S" : "") : l + " H:i" + (i.enableSeconds ? ":S" : "")
                    }
                    if (i.altInput && (i.enableTime || r) && !i.altFormat) {
                        var d = T.defaultConfig.altFormat || a.altFormat;
                        o.altFormat = i.noCalendar || r ? "h:i" + (i.enableSeconds ? ":S K" : " K") : d + " h:i" + (i.enableSeconds ? ":S" : "") + " K"
                    }
                    Object.defineProperty(w.config, "minDate", { get: function() { return w.config._minDate }, set: oe("min") }), Object.defineProperty(w.config, "maxDate", { get: function() { return w.config._maxDate }, set: oe("max") });
                    var s = function(e) { return function(t) { w.config["min" === e ? "_minTime" : "_maxTime"] = w.parseDate(t, "H:i:S") } };
                    Object.defineProperty(w.config, "minTime", { get: function() { return w.config._minTime }, set: s("min") }), Object.defineProperty(w.config, "maxTime", { get: function() { return w.config._maxTime }, set: s("max") }), "time" === i.mode && (w.config.noCalendar = !0, w.config.enableTime = !0);
                    Object.assign(w.config, o, i);
                    for (var u = 0; u < t.length; u++) w.config[t[u]] = !0 === w.config[t[u]] || "true" === w.config[t[u]];
                    n.filter((function(e) { return void 0 !== w.config[e] })).forEach((function(e) { w.config[e] = c(w.config[e] || []).map(E) })), w.isMobile = !w.config.disableMobile && !w.config.inline && "single" === w.config.mode && !w.config.disable.length && !w.config.enable && !w.config.weekNumbers && /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                    for (u = 0; u < w.config.plugins.length; u++) { var f = w.config.plugins[u](w) || {}; for (var m in f) n.indexOf(m) > -1 ? w.config[m] = c(f[m]).map(E).concat(w.config[m]) : void 0 === i[m] && (w.config[m] = f[m]) }
                    i.altInputClass || (w.config.altInputClass = re().className + " " + w.config.altInputClass);
                    pe("onParseConfig")
                }(), le(),
                function() {
                    if (w.input = re(), !w.input) return void w.config.errorHandler(new Error("Invalid input element specified"));
                    w.input._type = w.input.type, w.input.type = "text", w.input.classList.add("flatpickr-input"), w._input = w.input, w.config.altInput && (w.altInput = s(w.input.nodeName, w.config.altInputClass), w._input = w.altInput, w.altInput.placeholder = w.input.placeholder, w.altInput.disabled = w.input.disabled, w.altInput.required = w.input.required, w.altInput.tabIndex = w.input.tabIndex, w.altInput.type = "text", w.input.setAttribute("type", "hidden"), !w.config.static && w.input.parentNode && w.input.parentNode.insertBefore(w.altInput, w.input.nextSibling));
                    w.config.allowInput || w._input.setAttribute("readonly", "readonly");
                    w._positionElement = w.config.positionElement || w._input
                }(),
                function() {
                    w.selectedDates = [], w.now = w.parseDate(w.config.now) || new Date;
                    var e = w.config.defaultDate || ("INPUT" !== w.input.nodeName && "TEXTAREA" !== w.input.nodeName || !w.input.placeholder || w.input.value !== w.input.placeholder ? w.input.value : null);
                    e && me(e, w.config.dateFormat);
                    w._initialDate = w.selectedDates.length > 0 ? w.selectedDates[0] : w.config.minDate && w.config.minDate.getTime() > w.now.getTime() ? w.config.minDate : w.config.maxDate && w.config.maxDate.getTime() < w.now.getTime() ? w.config.maxDate : w.now, w.currentYear = w._initialDate.getFullYear(), w.currentMonth = w._initialDate.getMonth(), w.selectedDates.length > 0 && (w.latestSelectedDateObj = w.selectedDates[0]);
                    void 0 !== w.config.minTime && (w.config.minTime = w.parseDate(w.config.minTime, "H:i"));
                    void 0 !== w.config.maxTime && (w.config.maxTime = w.parseDate(w.config.maxTime, "H:i"));
                    w.minDateHasTime = !!w.config.minDate && (w.config.minDate.getHours() > 0 || w.config.minDate.getMinutes() > 0 || w.config.minDate.getSeconds() > 0), w.maxDateHasTime = !!w.config.maxDate && (w.config.maxDate.getHours() > 0 || w.config.maxDate.getMinutes() > 0 || w.config.maxDate.getSeconds() > 0)
                }(), w.utils = { getDaysInMonth: function(e, t) { return void 0 === e && (e = w.currentMonth), void 0 === t && (t = w.currentYear), 1 === e && (t % 4 == 0 && t % 100 != 0 || t % 400 == 0) ? 29 : w.l10n.daysInMonth[e] } }, w.isMobile || function() {
                    var e = window.document.createDocumentFragment();
                    if (w.calendarContainer = s("div", "flatpickr-calendar"), w.calendarContainer.tabIndex = -1, !w.config.noCalendar) {
                        if (e.appendChild((w.monthNav = s("div", "flatpickr-months"), w.yearElements = [], w.monthElements = [], w.prevMonthNav = s("span", "flatpickr-prev-month"), w.prevMonthNav.innerHTML = w.config.prevArrow, w.nextMonthNav = s("span", "flatpickr-next-month"), w.nextMonthNav.innerHTML = w.config.nextArrow, q(), Object.defineProperty(w, "_hidePrevMonthArrow", { get: function() { return w.__hidePrevMonthArrow }, set: function(e) { w.__hidePrevMonthArrow !== e && (d(w.prevMonthNav, "flatpickr-disabled", e), w.__hidePrevMonthArrow = e) } }), Object.defineProperty(w, "_hideNextMonthArrow", { get: function() { return w.__hideNextMonthArrow }, set: function(e) { w.__hideNextMonthArrow !== e && (d(w.nextMonthNav, "flatpickr-disabled", e), w.__hideNextMonthArrow = e) } }), w.currentYearElement = w.yearElements[0], De(), w.monthNav)), w.innerContainer = s("div", "flatpickr-innerContainer"), w.config.weekNumbers) {
                            var t = function() {
                                    w.calendarContainer.classList.add("hasWeeks");
                                    var e = s("div", "flatpickr-weekwrapper");
                                    e.appendChild(s("span", "flatpickr-weekday", w.l10n.weekAbbreviation));
                                    var t = s("div", "flatpickr-weeks");
                                    return e.appendChild(t), { weekWrapper: e, weekNumbers: t }
                                }(),
                                n = t.weekWrapper,
                                a = t.weekNumbers;
                            w.innerContainer.appendChild(n), w.weekNumbers = a, w.weekWrapper = n
                        }
                        w.rContainer = s("div", "flatpickr-rContainer"), w.rContainer.appendChild($()), w.daysContainer || (w.daysContainer = s("div", "flatpickr-days"), w.daysContainer.tabIndex = -1), J(), w.rContainer.appendChild(w.daysContainer), w.innerContainer.appendChild(w.rContainer), e.appendChild(w.innerContainer)
                    }
                    w.config.enableTime && e.appendChild(function() {
                        w.calendarContainer.classList.add("hasTime"), w.config.noCalendar && w.calendarContainer.classList.add("noCalendar");
                        var e = x(w.config);
                        w.timeContainer = s("div", "flatpickr-time"), w.timeContainer.tabIndex = -1;
                        var t = s("span", "flatpickr-time-separator", ":"),
                            n = m("flatpickr-hour", { "aria-label": w.l10n.hourAriaLabel });
                        w.hourElement = n.getElementsByTagName("input")[0];
                        var a = m("flatpickr-minute", { "aria-label": w.l10n.minuteAriaLabel });
                        w.minuteElement = a.getElementsByTagName("input")[0], w.hourElement.tabIndex = w.minuteElement.tabIndex = -1, w.hourElement.value = o(w.latestSelectedDateObj ? w.latestSelectedDateObj.getHours() : w.config.time_24hr ? e.hours : function(e) {
                            switch (e % 24) {
                                case 0:
                                case 12:
                                    return 12;
                                default:
                                    return e % 12
                            }
                        }(e.hours)), w.minuteElement.value = o(w.latestSelectedDateObj ? w.latestSelectedDateObj.getMinutes() : e.minutes), w.hourElement.setAttribute("step", w.config.hourIncrement.toString()), w.minuteElement.setAttribute("step", w.config.minuteIncrement.toString()), w.hourElement.setAttribute("min", w.config.time_24hr ? "0" : "1"), w.hourElement.setAttribute("max", w.config.time_24hr ? "23" : "12"), w.hourElement.setAttribute("maxlength", "2"), w.minuteElement.setAttribute("min", "0"), w.minuteElement.setAttribute("max", "59"), w.minuteElement.setAttribute("maxlength", "2"), w.timeContainer.appendChild(n), w.timeContainer.appendChild(t), w.timeContainer.appendChild(a), w.config.time_24hr && w.timeContainer.classList.add("time24hr");
                        if (w.config.enableSeconds) {
                            w.timeContainer.classList.add("hasSeconds");
                            var i = m("flatpickr-second");
                            w.secondElement = i.getElementsByTagName("input")[0], w.secondElement.value = o(w.latestSelectedDateObj ? w.latestSelectedDateObj.getSeconds() : e.seconds), w.secondElement.setAttribute("step", w.minuteElement.getAttribute("step")), w.secondElement.setAttribute("min", "0"), w.secondElement.setAttribute("max", "59"), w.secondElement.setAttribute("maxlength", "2"), w.timeContainer.appendChild(s("span", "flatpickr-time-separator", ":")), w.timeContainer.appendChild(i)
                        }
                        w.config.time_24hr || (w.amPM = s("span", "flatpickr-am-pm", w.l10n.amPM[r((w.latestSelectedDateObj ? w.hourElement.value : w.config.defaultHour) > 11)]), w.amPM.title = w.l10n.toggleTitle, w.amPM.tabIndex = -1, w.timeContainer.appendChild(w.amPM));
                        return w.timeContainer
                    }());
                    d(w.calendarContainer, "rangeMode", "range" === w.config.mode), d(w.calendarContainer, "animate", !0 === w.config.animate), d(w.calendarContainer, "multiMonth", w.config.showMonths > 1), w.calendarContainer.appendChild(e);
                    var i = void 0 !== w.config.appendTo && void 0 !== w.config.appendTo.nodeType;
                    if ((w.config.inline || w.config.static) && (w.calendarContainer.classList.add(w.config.inline ? "inline" : "static"), w.config.inline && (!i && w.element.parentNode ? w.element.parentNode.insertBefore(w.calendarContainer, w._input.nextSibling) : void 0 !== w.config.appendTo && w.config.appendTo.appendChild(w.calendarContainer)), w.config.static)) {
                        var l = s("div", "flatpickr-wrapper");
                        w.element.parentNode && w.element.parentNode.insertBefore(l, w.element), l.appendChild(w.element), w.altInput && l.appendChild(w.altInput), l.appendChild(w.calendarContainer)
                    }
                    w.config.static || w.config.inline || (void 0 !== w.config.appendTo ? w.config.appendTo : window.document.body).appendChild(w.calendarContainer)
                }(),
                function() {
                    w.config.wrap && ["open", "close", "toggle", "clear"].forEach((function(e) { Array.prototype.forEach.call(w.element.querySelectorAll("[data-" + e + "]"), (function(t) { return A(t, "click", w[e]) })) }));
                    if (w.isMobile) return void

                    function() {
                        var e = w.config.enableTime ? w.config.noCalendar ? "time" : "datetime-local" : "date";
                        w.mobileInput = s("input", w.input.className + " flatpickr-mobile"), w.mobileInput.tabIndex = 1, w.mobileInput.type = e, w.mobileInput.disabled = w.input.disabled, w.mobileInput.required = w.input.required, w.mobileInput.placeholder = w.input.placeholder, w.mobileFormatStr = "datetime-local" === e ? "Y-m-d\\TH:i:S" : "date" === e ? "Y-m-d" : "H:i:S", w.selectedDates.length > 0 && (w.mobileInput.defaultValue = w.mobileInput.value = w.formatDate(w.selectedDates[0], w.mobileFormatStr));
                        w.config.minDate && (w.mobileInput.min = w.formatDate(w.config.minDate, "Y-m-d"));
                        w.config.maxDate && (w.mobileInput.max = w.formatDate(w.config.maxDate, "Y-m-d"));
                        w.input.getAttribute("step") && (w.mobileInput.step = String(w.input.getAttribute("step")));
                        w.input.type = "hidden", void 0 !== w.altInput && (w.altInput.type = "hidden");
                        try { w.input.parentNode && w.input.parentNode.insertBefore(w.mobileInput, w.input.nextSibling) } catch (e) {}
                        A(w.mobileInput, "change", (function(e) { w.setDate(g(e).value, !1, w.mobileFormatStr), pe("onChange"), pe("onClose") }))
                    }();
                    var e = l(ie, 50);
                    w._debouncedChange = l(N, 300), w.daysContainer && !/iPhone|iPad|iPod/i.test(navigator.userAgent) && A(w.daysContainer, "mouseover", (function(e) { "range" === w.config.mode && ae(g(e)) }));
                    A(window.document.body, "keydown", ne), w.config.inline || w.config.static || A(window, "resize", e);
                    void 0 !== window.ontouchstart ? A(window.document, "touchstart", Z) : A(window.document, "mousedown", Z);
                    A(window.document, "focus", Z, { capture: !0 }), !0 === w.config.clickOpens && (A(w._input, "focus", w.open), A(w._input, "click", w.open));
                    void 0 !== w.daysContainer && (A(w.monthNav, "click", Ce), A(w.monthNav, ["keyup", "increment"], F), A(w.daysContainer, "click", ue));
                    if (void 0 !== w.timeContainer && void 0 !== w.minuteElement && void 0 !== w.hourElement) {
                        var t = function(e) { return g(e).select() };
                        A(w.timeContainer, ["increment"], I), A(w.timeContainer, "blur", I, { capture: !0 }), A(w.timeContainer, "click", Y), A([w.hourElement, w.minuteElement], ["focus", "click"], t), void 0 !== w.secondElement && A(w.secondElement, "focus", (function() { return w.secondElement && w.secondElement.select() })), void 0 !== w.amPM && A(w.amPM, "click", (function(e) { I(e), N() }))
                    }
                    w.config.allowInput && A(w._input, "blur", te)
                }(), (w.selectedDates.length || w.config.noCalendar) && (w.config.enableTime && _(w.config.noCalendar ? w.latestSelectedDateObj : void 0), be(!1)), k();
            var t = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
            !w.isMobile && t && ce(), pe("onReady")
        }(), w
    }

    function k(e, t) {
        for (var n = Array.prototype.slice.call(e).filter((function(e) { return e instanceof HTMLElement })), a = [], i = 0; i < n.length; i++) {
            var o = n[i];
            try {
                if (null !== o.getAttribute("data-fp-omit")) continue;
                void 0 !== o._flatpickr && (o._flatpickr.destroy(), o._flatpickr = void 0), o._flatpickr = E(o, t || {}), a.push(o._flatpickr)
            } catch (e) { console.error(e) }
        }
        return 1 === a.length ? a[0] : a
    }
    "undefined" != typeof HTMLElement && "undefined" != typeof HTMLCollection && "undefined" != typeof NodeList && (HTMLCollection.prototype.flatpickr = NodeList.prototype.flatpickr = function(e) { return k(this, e) }, HTMLElement.prototype.flatpickr = function(e) { return k([this], e) });
    var T = function(e, t) { return "string" == typeof e ? k(window.document.querySelectorAll(e), t) : e instanceof Node ? k([e], t) : k(e, t) };
    return T.defaultConfig = {}, T.l10ns = { en: e({}, i), default: e({}, i) }, T.localize = function(t) { T.l10ns.default = e(e({}, T.l10ns.default), t) }, T.setDefaults = function(t) { T.defaultConfig = e(e({}, T.defaultConfig), t) }, T.parseDate = C({}), T.formatDate = b({}), T.compareDates = M, "undefined" != typeof jQuery && void 0 !== jQuery.fn && (jQuery.fn.flatpickr = function(e) { return k(this, e) }), Date.prototype.fp_incr = function(e) { return new Date(this.getFullYear(), this.getMonth(), this.getDate() + ("string" == typeof e ? parseInt(e, 10) : e)) }, "undefined" != typeof window && (window.flatpickr = T), T
}));

/**
 * SyoTimer v.2.1.3 | under MIT licence
 * http://syomochkin.xyz/folio/syotimer/demo.html
 */
! function(i, e) { "function" == typeof define && define.amd ? define(["jquery"], i) : "object" == typeof module && module.exports ? module.exports = function(e, t) { return void 0 === t && (t = "undefined" != typeof window ? require("jquery") : require("jquery")(e)), i(t), t } : i(e) }(function(l) {
    var m = "day",
        a = "hour",
        s = "min",
        r = "sec",
        n = { d: m, h: a, m: s, s: r },
        d = { list: [r, s, a, m], next: function(e) { e = this.list.indexOf(e); return e < this.list.length && this.list[e + 1] }, prev: function(e) { e = this.list.indexOf(e); return 0 < e && this.list[e - 1] } },
        o = { year: 2034, month: 7, day: 31, hour: 0, min: 0, sec: 0, timeZone: "local", ignoreTransferTime: !1, layout: "dhms", periodic: !1, periodInterval: 7, periodUnit: "d", doubleNumbers: !0, effectType: "none", lang: "eng", headTitle: "", footTitle: "", afterDeadline: function(e) { e.bodyBlock.html('<p style="font-size: 1.2em;">The countdown is finished!</p>') } },
        u = { sec: !1, min: !1, hour: !1, day: !1 },
        c = {
            init: function(e) {
                var t = l.extend({}, o, e || {});
                t.itemTypes = y.getItemTypesByLayout(t.layout), t._itemsHas = l.extend({}, u);
                for (var i = 0; i < t.itemTypes.length; i++) t._itemsHas[t.itemTypes[i]] = !0;
                return this.each(function() { l(this).data("syotimer-options", t), c._render.apply(this, []), c._persecHandler.apply(this, []) })
            },
            _render: function() {
                for (var e = l(this), t = e.data("syotimer-options"), i = y.getTimerItem(), n = l("<div/>", { class: "syotimer__head" }).html(t.headTitle), o = l("<div/>", { class: "syotimer__body" }), r = l("<div/>", { class: "syotimer__footer" }).html(t.footTitle), a = {}, s = 0; s < t.itemTypes.length; s++) {
                    var d = i.clone();
                    d.addClass("syotimer-cell_type_" + t.itemTypes[s]), o.append(d), a[t.itemTypes[s]] = d
                }
                var u = { headBlock: n, bodyBlock: o, footBlock: r };
                e.data("syotimer-blocks", u).data("syotimer-items", a).addClass("syotimer").append(n).append(o).append(r)
            },
            _persecHandler: function() {
                var e = l(this),
                    t = e.data("syotimer-options");
                l(".syotimer-cell > .syotimer-cell__value", e).css("opacity", 1);
                var i = new Date,
                    n = new Date(t.year, t.month - 1, t.day, t.hour, t.min, t.sec),
                    n = y.getDifferenceWithTimezone(i, n, t),
                    n = y.getsecsToDeadLine(n, t);
                0 <= n ? (c._refreshUnitsDom.apply(this, [n]), c._applyEffectSwitch.apply(this, [t.effectType])) : (e = l.extend(e, e.data("syotimer-blocks")), t.afterDeadline(e))
            },
            _refreshUnitsDom: function(e) {
                var t = l(this),
                    i = t.data("syotimer-options"),
                    n = t.data("syotimer-items"),
                    o = i.itemTypes,
                    r = y.getUnitsToDeadLine(e);
                i._itemsHas.day || (r.hour += 24 * r.day), i._itemsHas.hour || (r.min += 60 * r.hour), i._itemsHas.min || (r.sec += 60 * r.min);
                for (var a = 0; a < o.length; a++) {
                    var s = o[a],
                        d = r[s],
                        u = n[s];
                    u.data("syotimer-unit-value", d), l(".syotimer-cell__value", u).html(y.format2(d, s !== m && i.doubleNumbers)), l(".syotimer-cell__unit", u).html(l.syotimerLang.getNumeral(d, i.lang, s))
                }
            },
            _applyEffectSwitch: function(e, t) {
                t = t || r;
                var i, n = this,
                    o = l(n);
                "none" === e ? setTimeout(function() { c._persecHandler.apply(n, []) }, 1e3) : "opacity" !== e || (i = o.data("syotimer-items")[t]) && (o = d.next(t), t = i.data("syotimer-unit-value"), l(".syotimer-cell__value", i).animate({ opacity: .1 }, 1e3, "linear", function() { c._persecHandler.apply(n, []) }), o && 0 === t && c._applyEffectSwitch.apply(n, [e, o]))
            }
        },
        y = {
            getTimerItem: function() {
                var e = l("<div/>", { class: "syotimer-cell__value", text: "0" }),
                    t = l("<div/>", { class: "syotimer-cell__unit" }),
                    i = l("<div/>", { class: "syotimer-cell" });
                return i.append(e).append(t), i
            },
            getItemTypesByLayout: function(e) { for (var t = [], i = 0; i < e.length; i++) t.push(n[e[i]]); return t },
            getsecsToDeadLine: function(e, t) {
                var i, n, o = e / 1e3,
                    o = Math.floor(o),
                    o = t.periodic ? (e = e / (1e3 * (n = y.getPeriodUnit(t.periodUnit))), e = Math.ceil(e), e = Math.abs(e), 0 <= o ? (i = 0 === (i = e % t.periodInterval) ? t.periodInterval : i, --i) : i = t.periodInterval - e % t.periodInterval, 0 == (t = o % n) && o < 0 && i--, Math.abs(i * n + t)) : o;
                return o
            },
            getUnitsToDeadLine: function(e) {
                var t = m,
                    i = {};
                do { var n = y.getPeriodUnit(t) } while (i[t] = Math.floor(e / n), e %= n, t = d.prev(t));
                return i
            },
            getPeriodUnit: function(e) {
                switch (e) {
                    case "d":
                    case m:
                        return 86400;
                    case "h":
                    case a:
                        return 3600;
                    case "m":
                    case s:
                        return 60;
                    case "s":
                    case r:
                        return 1
                }
            },
            getDifferenceWithTimezone: function(e, t, i) {
                var n = t.getTime() - e.getTime(),
                    o = 0,
                    r = 0;
                return "local" !== i.timeZone && (o = 1e3 * (parseFloat(i.timeZone) * y.getPeriodUnit(a) - -e.getTimezoneOffset() * y.getPeriodUnit(s))), i.ignoreTransferTime && (r = 1e3 * (-e.getTimezoneOffset() * y.getPeriodUnit(s) - -t.getTimezoneOffset() * y.getPeriodUnit(s))), n - (o + r)
            },
            format2: function(e, t) { return t = !1 !== t, e <= 9 && t ? "0" + e : "" + e }
        },
        i = {
            setOption: function(e, t) {
                var i = l(this),
                    n = i.data("syotimer-options");
                n.hasOwnProperty(e) && (n[e] = t, i.data("syotimer-options", n))
            }
        };
    l.fn.syotimer = function(e) {
        if ("string" == typeof e && "setOption" === e) { var t = Array.prototype.slice.call(arguments, 1); return this.each(function() { i[e].apply(this, t) }) }
        if (null == e || "object" == typeof e) return c.init.apply(this, [e]);
        l.error("SyoTimer. Error in call methods: methods is not exist")
    }, l.syotimerLang = { rus: { sec: ["секунда", "секунды", "секунд"], min: ["минута", "минуты", "минут"], hour: ["час", "часа", "часов"], day: ["день", "дня", "дней"], handler: "rusNumeral" }, eng: { sec: [""], min: [""], hour: [""], day: [""] }, por: { sec: ["segundo", "segundos"], min: ["minuto", "minutos"], hour: ["hora", "horas"], day: ["dia", "dias"] }, spa: { sec: ["segundo", "segundos"], min: ["minuto", "minutos"], hour: ["hora", "horas"], day: ["día", "días"] }, heb: { sec: ["שניה", "שניות"], min: ["דקה", "דקות"], hour: ["שעה", "שעות"], day: ["יום", "ימים"] }, universal: function(e) { return 1 === e ? 0 : 1 }, rusNumeral: function(e) { e = 4 < e % 100 && e % 100 < 20 ? 2 : [2, 0, 1, 1, 1, 2][e % 10 < 5 ? e % 10 : 5]; return e }, getNumeral: function(e, t, i) { e = this[l.syotimerLang[t].handler || "universal"](e); return l.syotimerLang[t][i][e] } }
}, window.jQuery);


! function(e, t) { "object" == typeof exports && "undefined" != typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define(t) : (e = e || self).Sweetalert2 = t() }(this, function() {
    "use strict";
    const t = "SweetAlert2:",
        v = e => e.charAt(0).toUpperCase() + e.slice(1),
        r = e => Array.prototype.slice.call(e),
        a = e => { console.warn("".concat(t, " ").concat("object" == typeof e ? e.join(" ") : e)) },
        y = e => { console.error("".concat(t, " ").concat(e)) },
        n = [],
        o = (e, t) => { e = '"'.concat(e, '" is deprecated and will be removed in the next major release. Please use "').concat(t, '" instead.'), n.includes(e) || (n.push(e), a(e)) },
        w = e => "function" == typeof e ? e() : e,
        C = e => e && "function" == typeof e.toPromise,
        k = e => C(e) ? e.toPromise() : Promise.resolve(e),
        A = e => e && Promise.resolve(e) === e,
        i = { title: "", titleText: "", text: "", html: "", footer: "", icon: void 0, iconColor: void 0, iconHtml: void 0, template: void 0, toast: !1, showClass: { popup: "swal2-show", backdrop: "swal2-backdrop-show", icon: "swal2-icon-show" }, hideClass: { popup: "swal2-hide", backdrop: "swal2-backdrop-hide", icon: "swal2-icon-hide" }, customClass: {}, target: "body", color: void 0, backdrop: !0, heightAuto: !0, allowOutsideClick: !0, allowEscapeKey: !0, allowEnterKey: !0, stopKeydownPropagation: !0, keydownListenerCapture: !1, showConfirmButton: !0, showDenyButton: !1, showCancelButton: !1, preConfirm: void 0, preDeny: void 0, confirmButtonText: "OK", confirmButtonAriaLabel: "", confirmButtonColor: void 0, denyButtonText: "No", denyButtonAriaLabel: "", denyButtonColor: void 0, cancelButtonText: "Cancel", cancelButtonAriaLabel: "", cancelButtonColor: void 0, buttonsStyling: !0, reverseButtons: !1, focusConfirm: !0, focusDeny: !1, focusCancel: !1, returnFocus: !0, showCloseButton: !1, closeButtonHtml: "&times;", closeButtonAriaLabel: "Close this dialog", loaderHtml: "", showLoaderOnConfirm: !1, showLoaderOnDeny: !1, imageUrl: void 0, imageWidth: void 0, imageHeight: void 0, imageAlt: "", timer: void 0, timerProgressBar: !1, width: void 0, padding: void 0, background: void 0, input: void 0, inputPlaceholder: "", inputLabel: "", inputValue: "", inputOptions: {}, inputAutoTrim: !0, inputAttributes: {}, inputValidator: void 0, returnInputValueOnDeny: !1, validationMessage: void 0, grow: !1, position: "center", progressSteps: [], currentProgressStep: void 0, progressStepsDistance: void 0, willOpen: void 0, didOpen: void 0, didRender: void 0, willClose: void 0, didClose: void 0, didDestroy: void 0, scrollbarPadding: !0 },
        s = ["allowEscapeKey", "allowOutsideClick", "background", "buttonsStyling", "cancelButtonAriaLabel", "cancelButtonColor", "cancelButtonText", "closeButtonAriaLabel", "closeButtonHtml", "color", "confirmButtonAriaLabel", "confirmButtonColor", "confirmButtonText", "currentProgressStep", "customClass", "denyButtonAriaLabel", "denyButtonColor", "denyButtonText", "didClose", "didDestroy", "footer", "hideClass", "html", "icon", "iconColor", "iconHtml", "imageAlt", "imageHeight", "imageUrl", "imageWidth", "preConfirm", "preDeny", "progressSteps", "returnFocus", "reverseButtons", "showCancelButton", "showCloseButton", "showConfirmButton", "showDenyButton", "text", "title", "titleText", "willClose"],
        c = {},
        P = ["allowOutsideClick", "allowEnterKey", "backdrop", "focusConfirm", "focusDeny", "focusCancel", "returnFocus", "heightAuto", "keydownListenerCapture"],
        B = e => Object.prototype.hasOwnProperty.call(i, e),
        x = e => -1 !== s.indexOf(e),
        E = e => c[e],
        T = e => {!e.backdrop && e.allowOutsideClick && a('"allowOutsideClick" parameter requires `backdrop` parameter to be set to `true`'); for (const n in e) t = n, B(t) || a('Unknown parameter "'.concat(t, '"')), e.toast && (t = n, P.includes(t) && a('The parameter "'.concat(t, '" is incompatible with toasts'))), t = n, E(t) && o(t, E(t)); var t };
    var e = e => { const t = {}; for (const n in e) t[e[n]] = "swal2-" + e[n]; return t };
    const p = e(["container", "shown", "height-auto", "iosfix", "popup", "modal", "no-backdrop", "no-transition", "toast", "toast-shown", "show", "hide", "close", "title", "html-container", "actions", "confirm", "deny", "cancel", "default-outline", "footer", "icon", "icon-content", "image", "input", "file", "range", "select", "radio", "checkbox", "label", "textarea", "inputerror", "input-label", "validation-message", "progress-steps", "active-progress-step", "progress-step", "progress-step-line", "loader", "loading", "styled", "top", "top-start", "top-end", "top-left", "top-right", "center", "center-start", "center-end", "center-left", "center-right", "bottom", "bottom-start", "bottom-end", "bottom-left", "bottom-right", "grow-row", "grow-column", "grow-fullscreen", "rtl", "timer-progress-bar", "timer-progress-bar-container", "scrollbar-measure", "icon-success", "icon-warning", "icon-info", "icon-question", "icon-error"]),
        S = e(["success", "warning", "info", "question", "error"]),
        m = () => document.body.querySelector(".".concat(p.container)),
        L = e => { const t = m(); return t ? t.querySelector(e) : null },
        O = e => L(".".concat(e)),
        g = () => O(p.popup),
        j = () => O(p.icon),
        M = () => O(p.title),
        D = () => O(p["html-container"]),
        I = () => O(p.image),
        H = () => O(p["progress-steps"]),
        q = () => O(p["validation-message"]),
        V = () => L(".".concat(p.actions, " .").concat(p.confirm)),
        N = () => L(".".concat(p.actions, " .").concat(p.deny));
    const R = () => L(".".concat(p.loader)),
        F = () => L(".".concat(p.actions, " .").concat(p.cancel)),
        U = () => O(p.actions),
        W = () => O(p.footer),
        z = () => O(p["timer-progress-bar"]),
        _ = () => O(p.close),
        K = () => { const e = r(g().querySelectorAll('[tabindex]:not([tabindex="-1"]):not([tabindex="0"])')).sort((e, t) => { e = parseInt(e.getAttribute("tabindex")), t = parseInt(t.getAttribute("tabindex")); return t < e ? 1 : e < t ? -1 : 0 }); var t = r(g().querySelectorAll('\n  a[href],\n  area[href],\n  input:not([disabled]),\n  select:not([disabled]),\n  textarea:not([disabled]),\n  button:not([disabled]),\n  iframe,\n  object,\n  embed,\n  [tabindex="0"],\n  [contenteditable],\n  audio[controls],\n  video[controls],\n  summary\n')).filter(e => "-1" !== e.getAttribute("tabindex")); return (t => { const n = []; for (let e = 0; e < t.length; e++) - 1 === n.indexOf(t[e]) && n.push(t[e]); return n })(e.concat(t)).filter(e => se(e)) },
        Y = () => !$(document.body, p["toast-shown"]) && !$(document.body, p["no-backdrop"]),
        Z = () => g() && $(g(), p.toast);

    function J(e) {
        var t = 1 < arguments.length && void 0 !== arguments[1] && arguments[1];
        const n = z();
        se(n) && (t && (n.style.transition = "none", n.style.width = "100%"), setTimeout(() => { n.style.transition = "width ".concat(e / 1e3, "s linear"), n.style.width = "0%" }, 10))
    }
    const X = { previousBodyPadding: null },
        l = (t, e) => {
            if (t.textContent = "", e) {
                const n = new DOMParser,
                    o = n.parseFromString(e, "text/html");
                r(o.querySelector("head").childNodes).forEach(e => { t.appendChild(e) }), r(o.querySelector("body").childNodes).forEach(e => { t.appendChild(e) })
            }
        },
        $ = (t, e) => {
            if (!e) return !1;
            var n = e.split(/\s+/);
            for (let e = 0; e < n.length; e++)
                if (!t.classList.contains(n[e])) return !1;
            return !0
        },
        G = (e, t, n) => {
            var o, i;
            if (o = e, i = t, r(o.classList).forEach(e => { Object.values(p).includes(e) || Object.values(S).includes(e) || Object.values(i.showClass).includes(e) || o.classList.remove(e) }), t.customClass && t.customClass[n]) {
                if ("string" != typeof t.customClass[n] && !t.customClass[n].forEach) return a("Invalid type of customClass.".concat(n, '! Expected string or iterable object, got "').concat(typeof t.customClass[n], '"'));
                u(e, t.customClass[n])
            }
        },
        Q = (e, t) => {
            if (!t) return null;
            switch (t) {
                case "select":
                case "textarea":
                case "file":
                    return e.querySelector(".".concat(p.popup, " > .").concat(p[t]));
                case "checkbox":
                    return e.querySelector(".".concat(p.popup, " > .").concat(p.checkbox, " input"));
                case "radio":
                    return e.querySelector(".".concat(p.popup, " > .").concat(p.radio, " input:checked")) || e.querySelector(".".concat(p.popup, " > .").concat(p.radio, " input:first-child"));
                case "range":
                    return e.querySelector(".".concat(p.popup, " > .").concat(p.range, " input"));
                default:
                    return e.querySelector(".".concat(p.popup, " > .").concat(p.input))
            }
        },
        ee = e => {
            var t;
            e.focus(), "file" !== e.type && (t = e.value, e.value = "", e.value = t)
        },
        te = (e, t, n) => { e && t && (t = "string" == typeof t ? t.split(/\s+/).filter(Boolean) : t).forEach(t => { Array.isArray(e) ? e.forEach(e => { n ? e.classList.add(t) : e.classList.remove(t) }) : n ? e.classList.add(t) : e.classList.remove(t) }) },
        u = (e, t) => { te(e, t, !0) },
        ne = (e, t) => { te(e, t, !1) },
        oe = (e, t) => {
            var n = r(e.childNodes);
            for (let e = 0; e < n.length; e++)
                if ($(n[e], t)) return n[e]
        },
        ie = (e, t, n) => {
            (n = n === "".concat(parseInt(n)) ? parseInt(n) : n) || 0 === parseInt(n) ? e.style[t] = "number" == typeof n ? "".concat(n, "px") : n : e.style.removeProperty(t)
        },
        d = function(e) { e.style.display = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "flex" },
        h = e => { e.style.display = "none" },
        ae = (e, t, n, o) => {
            const i = e.querySelector(t);
            i && (i.style[n] = o)
        },
        re = (e, t, n) => { t ? d(e, n) : h(e) },
        se = e => !(!e || !(e.offsetWidth || e.offsetHeight || e.getClientRects().length)),
        ce = () => !se(V()) && !se(N()) && !se(F()),
        le = e => !!(e.scrollHeight > e.clientHeight),
        ue = e => {
            const t = window.getComputedStyle(e);
            var e = parseFloat(t.getPropertyValue("animation-duration") || "0"),
                n = parseFloat(t.getPropertyValue("transition-duration") || "0");
            return 0 < e || 0 < n
        },
        de = () => "undefined" == typeof window || "undefined" == typeof document,
        pe = 100,
        f = {},
        me = () => { f.previousActiveElement && f.previousActiveElement.focus ? (f.previousActiveElement.focus(), f.previousActiveElement = null) : document.body && document.body.focus() },
        ge = o => new Promise(e => {
            if (!o) return e();
            var t = window.scrollX,
                n = window.scrollY;
            f.restoreFocusTimeout = setTimeout(() => { me(), e() }, pe), window.scrollTo(t, n)
        }),
        he = '\n <div aria-labelledby="'.concat(p.title, '" aria-describedby="').concat(p["html-container"], '" class="').concat(p.popup, '" tabindex="-1">\n   <button type="button" class="').concat(p.close, '"></button>\n   <ul class="').concat(p["progress-steps"], '"></ul>\n   <div class="').concat(p.icon, '"></div>\n   <img class="').concat(p.image, '" />\n   <h2 class="').concat(p.title, '" id="').concat(p.title, '"></h2>\n   <div class="').concat(p["html-container"], '" id="').concat(p["html-container"], '"></div>\n   <input class="').concat(p.input, '" />\n   <input type="file" class="').concat(p.file, '" />\n   <div class="').concat(p.range, '">\n     <input type="range" />\n     <output></output>\n   </div>\n   <select class="').concat(p.select, '"></select>\n   <div class="').concat(p.radio, '"></div>\n   <label for="').concat(p.checkbox, '" class="').concat(p.checkbox, '">\n     <input type="checkbox" />\n     <span class="').concat(p.label, '"></span>\n   </label>\n   <textarea class="').concat(p.textarea, '"></textarea>\n   <div class="').concat(p["validation-message"], '" id="').concat(p["validation-message"], '"></div>\n   <div class="').concat(p.actions, '">\n     <div class="').concat(p.loader, '"></div>\n     <button type="button" class="').concat(p.confirm, '"></button>\n     <button type="button" class="').concat(p.deny, '"></button>\n     <button type="button" class="').concat(p.cancel, '"></button>\n   </div>\n   <div class="').concat(p.footer, '"></div>\n   <div class="').concat(p["timer-progress-bar-container"], '">\n     <div class="').concat(p["timer-progress-bar"], '"></div>\n   </div>\n </div>\n').replace(/(^|\n)\s*/g, ""),
        fe = () => { const e = m(); return !!e && (e.remove(), ne([document.documentElement, document.body], [p["no-backdrop"], p["toast-shown"], p["has-column"]]), !0) },
        be = () => { f.currentInstance.resetValidationMessage() },
        ve = () => {
            const e = g(),
                t = oe(e, p.input),
                n = oe(e, p.file),
                o = e.querySelector(".".concat(p.range, " input")),
                i = e.querySelector(".".concat(p.range, " output")),
                a = oe(e, p.select),
                r = e.querySelector(".".concat(p.checkbox, " input")),
                s = oe(e, p.textarea);
            t.oninput = be, n.onchange = be, a.onchange = be, r.onchange = be, s.oninput = be, o.oninput = () => { be(), i.value = o.value }, o.onchange = () => { be(), o.nextSibling.value = o.value }
        },
        ye = e => "string" == typeof e ? document.querySelector(e) : e,
        we = e => {
            const t = g();
            t.setAttribute("role", e.toast ? "alert" : "dialog"), t.setAttribute("aria-live", e.toast ? "polite" : "assertive"), e.toast || t.setAttribute("aria-modal", "true")
        },
        Ce = e => { "rtl" === window.getComputedStyle(e).direction && u(m(), p.rtl) },
        ke = (e, t) => {
            if (e instanceof HTMLElement) t.appendChild(e);
            else if ("object" == typeof e) {
                var n = e,
                    o = t;
                if (n.jquery) Ae(o, n);
                else l(o, n.toString())
            } else e && l(t, e)
        },
        Ae = (t, n) => {
            if (t.textContent = "", 0 in n)
                for (let e = 0; e in n; e++) t.appendChild(n[e].cloneNode(!0));
            else t.appendChild(n.cloneNode(!0))
        },
        Pe = (() => {
            if (de()) return !1;
            var e = document.createElement("div"),
                t = { WebkitAnimation: "webkitAnimationEnd", animation: "animationend" };
            for (const n in t)
                if (Object.prototype.hasOwnProperty.call(t, n) && void 0 !== e.style[n]) return t[n];
            return !1
        })(),
        Be = (e, t) => {
            var n, o, i, a, r, s = U(),
                c = R();
            (t.showConfirmButton || t.showDenyButton || t.showCancelButton ? d : h)(s), G(s, t, "actions"), s = s, n = c, o = t, i = V(), a = N(), r = F(), xe(i, "confirm", o), xe(a, "deny", o), xe(r, "cancel", o),
                function(e, t, n, o) {
                    if (!o.buttonsStyling) return ne([e, t, n], p.styled);
                    u([e, t, n], p.styled), o.confirmButtonColor && (e.style.backgroundColor = o.confirmButtonColor, u(e, p["default-outline"]));
                    o.denyButtonColor && (t.style.backgroundColor = o.denyButtonColor, u(t, p["default-outline"]));
                    o.cancelButtonColor && (n.style.backgroundColor = o.cancelButtonColor, u(n, p["default-outline"]))
                }(i, a, r, o), o.reverseButtons && (o.toast ? (s.insertBefore(r, i), s.insertBefore(a, i)) : (s.insertBefore(r, n), s.insertBefore(a, n), s.insertBefore(i, n))), l(c, t.loaderHtml), G(c, t, "loader")
        };

    function xe(e, t, n) { re(e, n["show".concat(v(t), "Button")], "inline-block"), l(e, n["".concat(t, "ButtonText")]), e.setAttribute("aria-label", n["".concat(t, "ButtonAriaLabel")]), e.className = p[t], G(e, n, "".concat(t, "Button")), u(e, n["".concat(t, "ButtonClass")]) }
    const Ee = (e, t) => {
        var n, o, i = m();
        i && (o = i, "string" == typeof(n = t.backdrop) ? o.style.background = n : n || u([document.documentElement, document.body], p["no-backdrop"]), o = i, (n = t.position) in p ? u(o, p[n]) : (a('The "position" parameter is not valid, defaulting to "center"'), u(o, p.center)), n = i, !(o = t.grow) || "string" != typeof o || (o = "grow-".concat(o)) in p && u(n, p[o]), G(i, t, "container"))
    };
    var b = { awaitingPromise: new WeakMap, promise: new WeakMap, innerParams: new WeakMap, domCache: new WeakMap };
    const Te = ["input", "file", "range", "select", "radio", "checkbox", "textarea"],
        Se = (e, r) => {
            const s = g();
            var t, e = b.innerParams.get(e);
            const c = !e || r.input !== e.input;
            Te.forEach(e => {
                var t = p[e];
                const n = oe(s, t); { var o = r.inputAttributes; const i = Q(g(), e); if (i) { Le(i); for (const a in o) i.setAttribute(a, o[a]) } }
                n.className = t, c && h(n)
            }), r.input && (c && (e => {
                if (!De[e.input]) return y('Unexpected type of input! Expected "text", "email", "password", "number", "tel", "select", "radio", "checkbox", "textarea", "file" or "url", got "'.concat(e.input, '"'));
                const t = Me(e.input),
                    n = De[e.input](t, e);
                d(n), setTimeout(() => { ee(n) })
            })(r), e = r, t = Me(e.input), e.customClass && u(t, e.customClass.input))
        },
        Le = t => {
            for (let e = 0; e < t.attributes.length; e++) {
                var n = t.attributes[e].name;
                ["type", "value", "style"].includes(n) || t.removeAttribute(n)
            }
        },
        Oe = (e, t) => { e.placeholder && !t.inputPlaceholder || (e.placeholder = t.inputPlaceholder) },
        je = (e, t, n) => {
            if (n.inputLabel) {
                e.id = p.input;
                const i = document.createElement("label");
                var o = p["input-label"];
                i.setAttribute("for", e.id), i.className = o, u(i, n.customClass.inputLabel), i.innerText = n.inputLabel, t.insertAdjacentElement("beforebegin", i)
            }
        },
        Me = e => { e = p[e] || p.input; return oe(g(), e) },
        De = {},
        Ie = (De.text = De.email = De.password = De.number = De.tel = De.url = (e, t) => ("string" == typeof t.inputValue || "number" == typeof t.inputValue ? e.value = t.inputValue : A(t.inputValue) || a('Unexpected type of inputValue! Expected "string", "number" or "Promise", got "'.concat(typeof t.inputValue, '"')), je(e, e, t), Oe(e, t), e.type = t.input, e), De.file = (e, t) => (je(e, e, t), Oe(e, t), e), De.range = (e, t) => {
            const n = e.querySelector("input"),
                o = e.querySelector("output");
            return n.value = t.inputValue, n.type = t.input, o.value = t.inputValue, je(n, e, t), e
        }, De.select = (e, t) => {
            if (e.textContent = "", t.inputPlaceholder) {
                const n = document.createElement("option");
                l(n, t.inputPlaceholder), n.value = "", n.disabled = !0, n.selected = !0, e.appendChild(n)
            }
            return je(e, e, t), e
        }, De.radio = e => (e.textContent = "", e), De.checkbox = (e, t) => {
            const n = Q(g(), "checkbox");
            n.value = "1", n.id = p.checkbox, n.checked = Boolean(t.inputValue);
            var o = e.querySelector("span");
            return l(o, t.inputPlaceholder), e
        }, De.textarea = (n, e) => {
            n.value = e.inputValue, Oe(n, e), je(n, n, e);
            return setTimeout(() => {
                if ("MutationObserver" in window) {
                    const t = parseInt(window.getComputedStyle(g()).width);
                    new MutationObserver(() => {
                        var e = n.offsetWidth + (e = n, parseInt(window.getComputedStyle(e).marginLeft) + parseInt(window.getComputedStyle(e).marginRight));
                        e > t ? g().style.width = "".concat(e, "px") : g().style.width = null
                    }).observe(n, { attributes: !0, attributeFilter: ["style"] })
                }
            }), n
        }, (e, t) => {
            const n = D();
            G(n, t, "htmlContainer"), t.html ? (ke(t.html, n), d(n, "block")) : t.text ? (n.textContent = t.text, d(n, "block")) : h(n), Se(e, t)
        }),
        He = (e, t) => {
            var n = W();
            re(n, t.footer), t.footer && ke(t.footer, n), G(n, t, "footer")
        },
        qe = (e, t) => {
            const n = _();
            l(n, t.closeButtonHtml), G(n, t, "closeButton"), re(n, t.showCloseButton), n.setAttribute("aria-label", t.closeButtonAriaLabel)
        },
        Ve = (e, t) => {
            var e = b.innerParams.get(e),
                n = j();
            return e && t.icon === e.icon ? (We(n, t), void Ne(n, t)) : t.icon || t.iconHtml ? t.icon && -1 === Object.keys(S).indexOf(t.icon) ? (y('Unknown icon! Expected "success", "error", "warning", "info" or "question", got "'.concat(t.icon, '"')), h(n)) : (d(n), We(n, t), Ne(n, t), void u(n, t.showClass.icon)) : h(n)
        },
        Ne = (e, t) => {
            for (const n in S) t.icon !== n && ne(e, S[n]);
            u(e, S[t.icon]), ze(e, t), Re(), G(e, t, "icon")
        },
        Re = () => { const e = g(); var t = window.getComputedStyle(e).getPropertyValue("background-color"); const n = e.querySelectorAll("[class^=swal2-success-circular-line], .swal2-success-fix"); for (let e = 0; e < n.length; e++) n[e].style.backgroundColor = t },
        Fe = '\n  <div class="swal2-success-circular-line-left"></div>\n  <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>\n  <div class="swal2-success-ring"></div> <div class="swal2-success-fix"></div>\n  <div class="swal2-success-circular-line-right"></div>\n',
        Ue = '\n  <span class="swal2-x-mark">\n    <span class="swal2-x-mark-line-left"></span>\n    <span class="swal2-x-mark-line-right"></span>\n  </span>\n',
        We = (e, t) => {
            var n;
            e.textContent = "", t.iconHtml ? l(e, _e(t.iconHtml)) : "success" === t.icon ? l(e, Fe) : "error" === t.icon ? l(e, Ue) : (n = { question: "?", warning: "!", info: "i" }, l(e, _e(n[t.icon])))
        },
        ze = (e, t) => {
            if (t.iconColor) {
                e.style.color = t.iconColor, e.style.borderColor = t.iconColor;
                for (const n of[".swal2-success-line-tip", ".swal2-success-line-long", ".swal2-x-mark-line-left", ".swal2-x-mark-line-right"]) ae(e, n, "backgroundColor", t.iconColor);
                ae(e, ".swal2-success-ring", "borderColor", t.iconColor)
            }
        },
        _e = e => '<div class="'.concat(p["icon-content"], '">').concat(e, "</div>"),
        Ke = (e, t) => {
            const n = I();
            if (!t.imageUrl) return h(n);
            d(n, ""), n.setAttribute("src", t.imageUrl), n.setAttribute("alt", t.imageAlt), ie(n, "width", t.imageWidth), ie(n, "height", t.imageHeight), n.className = p.image, G(n, t, "image")
        },
        Ye = (e, o) => {
            const i = H();
            if (!o.progressSteps || 0 === o.progressSteps.length) return h(i);
            d(i), i.textContent = "", o.currentProgressStep >= o.progressSteps.length && a("Invalid currentProgressStep parameter, it should be less than progressSteps.length (currentProgressStep like JS arrays starts from 0)"), o.progressSteps.forEach((e, t) => {
                e = e, n = document.createElement("li"), u(n, p["progress-step"]), l(n, e);
                var n, e = n;
                i.appendChild(e), t === o.currentProgressStep && u(e, p["active-progress-step"]), t !== o.progressSteps.length - 1 && (n = (e => { const t = document.createElement("li"); return u(t, p["progress-step-line"]), e.progressStepsDistance && (t.style.width = e.progressStepsDistance), t })(o), i.appendChild(n))
            })
        },
        Ze = (e, t) => {
            const n = M();
            re(n, t.title || t.titleText, "block"), t.title && ke(t.title, n), t.titleText && (n.innerText = t.titleText), G(n, t, "title")
        },
        Je = (e, t) => {
            var n = m();
            const o = g();
            t.toast ? (ie(n, "width", t.width), o.style.width = "100%", o.insertBefore(R(), j())) : ie(o, "width", t.width), ie(o, "padding", t.padding), t.color && (o.style.color = t.color), t.background && (o.style.background = t.background), h(q());
            n = o;
            (n.className = "".concat(p.popup, " ").concat(se(n) ? t.showClass.popup : ""), t.toast) ? (u([document.documentElement, document.body], p["toast-shown"]), u(n, p.toast)) : u(n, p.modal);
            G(n, t, "popup"), "string" == typeof t.customClass && u(n, t.customClass);
            t.icon && u(n, p["icon-".concat(t.icon)])
        },
        Xe = (e, t) => { Je(e, t), Ee(e, t), Ye(e, t), Ve(e, t), Ke(e, t), Ze(e, t), qe(e, t), Ie(e, t), Be(e, t), He(e, t), "function" == typeof t.didRender && t.didRender(g()) },
        $e = Object.freeze({ cancel: "cancel", backdrop: "backdrop", close: "close", esc: "esc", timer: "timer" }),
        Ge = () => {
            const e = r(document.body.children);
            e.forEach(e => { e === m() || e.contains(m()) || (e.hasAttribute("aria-hidden") && e.setAttribute("data-previous-aria-hidden", e.getAttribute("aria-hidden")), e.setAttribute("aria-hidden", "true")) })
        },
        Qe = () => {
            const e = r(document.body.children);
            e.forEach(e => { e.hasAttribute("data-previous-aria-hidden") ? (e.setAttribute("aria-hidden", e.getAttribute("data-previous-aria-hidden")), e.removeAttribute("data-previous-aria-hidden")) : e.removeAttribute("aria-hidden") })
        },
        et = ["swal-title", "swal-html", "swal-footer"],
        tt = e => {
            const n = {};
            return r(e.querySelectorAll("swal-param")).forEach(e => {
                ct(e, ["name", "value"]);
                var t = e.getAttribute("name"),
                    e = e.getAttribute("value");
                "boolean" == typeof i[t] && "false" === e && (n[t] = !1), "object" == typeof i[t] && (n[t] = JSON.parse(e))
            }), n
        },
        nt = e => {
            const n = {};
            return r(e.querySelectorAll("swal-button")).forEach(e => {
                ct(e, ["type", "color", "aria-label"]);
                var t = e.getAttribute("type");
                n["".concat(t, "ButtonText")] = e.innerHTML, n["show".concat(v(t), "Button")] = !0, e.hasAttribute("color") && (n["".concat(t, "ButtonColor")] = e.getAttribute("color")), e.hasAttribute("aria-label") && (n["".concat(t, "ButtonAriaLabel")] = e.getAttribute("aria-label"))
            }), n
        },
        ot = e => {
            const t = {},
                n = e.querySelector("swal-image");
            return n && (ct(n, ["src", "width", "height", "alt"]), n.hasAttribute("src") && (t.imageUrl = n.getAttribute("src")), n.hasAttribute("width") && (t.imageWidth = n.getAttribute("width")), n.hasAttribute("height") && (t.imageHeight = n.getAttribute("height")), n.hasAttribute("alt") && (t.imageAlt = n.getAttribute("alt"))), t
        },
        it = e => {
            const t = {},
                n = e.querySelector("swal-icon");
            return n && (ct(n, ["type", "color"]), n.hasAttribute("type") && (t.icon = n.getAttribute("type")), n.hasAttribute("color") && (t.iconColor = n.getAttribute("color")), t.iconHtml = n.innerHTML), t
        },
        at = e => {
            const n = {},
                t = e.querySelector("swal-input");
            t && (ct(t, ["type", "label", "placeholder", "value"]), n.input = t.getAttribute("type") || "text", t.hasAttribute("label") && (n.inputLabel = t.getAttribute("label")), t.hasAttribute("placeholder") && (n.inputPlaceholder = t.getAttribute("placeholder")), t.hasAttribute("value") && (n.inputValue = t.getAttribute("value")));
            e = e.querySelectorAll("swal-input-option");
            return e.length && (n.inputOptions = {}, r(e).forEach(e => {
                ct(e, ["value"]);
                var t = e.getAttribute("value"),
                    e = e.innerHTML;
                n.inputOptions[t] = e
            })), n
        },
        rt = (e, t) => {
            const n = {};
            for (const o in t) {
                const i = t[o],
                    a = e.querySelector(i);
                a && (ct(a, []), n[i.replace(/^swal-/, "")] = a.innerHTML.trim())
            }
            return n
        },
        st = e => {
            const t = et.concat(["swal-param", "swal-button", "swal-image", "swal-icon", "swal-input", "swal-input-option"]);
            r(e.children).forEach(e => { e = e.tagName.toLowerCase(); - 1 === t.indexOf(e) && a("Unrecognized element <".concat(e, ">")) })
        },
        ct = (t, n) => { r(t.attributes).forEach(e => {-1 === n.indexOf(e.name) && a(['Unrecognized attribute "'.concat(e.name, '" on <').concat(t.tagName.toLowerCase(), ">."), "".concat(n.length ? "Allowed attributes are: ".concat(n.join(", ")) : "To set the value, use HTML within the element.")]) }) };
    var lt = { email: (e, t) => /^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9-]{2,24}$/.test(e) ? Promise.resolve() : Promise.resolve(t || "Invalid email address"), url: (e, t) => /^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._+~#=]{1,256}\.[a-z]{2,63}\b([-a-zA-Z0-9@:%_+.~#?&/=]*)$/.test(e) ? Promise.resolve() : Promise.resolve(t || "Invalid URL") };

    function ut(e) {
        (t = e).inputValidator || Object.keys(lt).forEach(e => { t.input === e && (t.inputValidator = lt[e]) }), e.showLoaderOnConfirm && !e.preConfirm && a("showLoaderOnConfirm is set to true, but preConfirm is not defined.\nshowLoaderOnConfirm should be used together with preConfirm, see usage example:\nhttps://sweetalert2.github.io/#ajax-request"), (n = e).target && ("string" != typeof n.target || document.querySelector(n.target)) && ("string" == typeof n.target || n.target.appendChild) || (a('Target parameter is not valid, defaulting to "body"'), n.target = "body"), "string" == typeof e.title && (e.title = e.title.split("\n").join("<br />"));
        var t, n = e,
            e = fe();
        if (de()) y("SweetAlert2 requires document to initialize");
        else {
            const o = document.createElement("div"),
                i = (o.className = p.container, e && u(o, p["no-transition"]), l(o, he), ye(n.target));
            i.appendChild(o), we(n), Ce(i), ve()
        }
    }
    class dt {
        constructor(e, t) { this.callback = e, this.remaining = t, this.running = !1, this.start() }
        start() { return this.running || (this.running = !0, this.started = new Date, this.id = setTimeout(this.callback, this.remaining)), this.remaining }
        stop() { return this.running && (this.running = !1, clearTimeout(this.id), this.remaining -= (new Date).getTime() - this.started.getTime()), this.remaining }
        increase(e) { var t = this.running; return t && this.stop(), this.remaining += e, t && this.start(), this.remaining }
        getTimerLeft() { return this.running && (this.stop(), this.start()), this.remaining }
        isRunning() { return this.running }
    }
    const pt = () => {
            null === X.previousBodyPadding && document.body.scrollHeight > window.innerHeight && (X.previousBodyPadding = parseInt(window.getComputedStyle(document.body).getPropertyValue("padding-right")), document.body.style.paddingRight = "".concat(X.previousBodyPadding + (() => {
                const e = document.createElement("div");
                e.className = p["scrollbar-measure"], document.body.appendChild(e);
                var t = e.getBoundingClientRect().width - e.clientWidth;
                return document.body.removeChild(e), t
            })(), "px"))
        },
        mt = () => { null !== X.previousBodyPadding && (document.body.style.paddingRight = "".concat(X.previousBodyPadding, "px"), X.previousBodyPadding = null) },
        gt = () => {
            var e = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream || "MacIntel" === navigator.platform && 1 < navigator.maxTouchPoints;
            if (e && !$(document.body, p.iosfix)) {
                var t, e = document.body.scrollTop;
                document.body.style.top = "".concat(-1 * e, "px"), u(document.body, p.iosfix); {
                    const n = m();
                    let t;
                    n.ontouchstart = e => { t = ht(e) }, n.ontouchmove = e => { t && (e.preventDefault(), e.stopPropagation()) }
                } {
                    const o = navigator.userAgent,
                        i = !!o.match(/iPad/i) || !!o.match(/iPhone/i),
                        a = !!o.match(/WebKit/i),
                        r = i && a && !o.match(/CriOS/i);
                    r && (t = 44, g().scrollHeight > window.innerHeight - 44 && (m().style.paddingBottom = "".concat(44, "px")))
                }
            }
        },
        ht = e => {
            var t, n = e.target,
                o = m();
            return !((t = e).touches && t.touches.length && "stylus" === t.touches[0].touchType || (t = e).touches && 1 < t.touches.length) && (n === o || !(le(o) || "INPUT" === n.tagName || "TEXTAREA" === n.tagName || le(D()) && D().contains(n)))
        },
        ft = () => {
            var e;
            $(document.body, p.iosfix) && (e = parseInt(document.body.style.top, 10), ne(document.body, p.iosfix), document.body.style.top = "", document.body.scrollTop = -1 * e)
        },
        bt = 10,
        vt = e => {
            const t = g();
            if (e.target === t) {
                const n = m();
                t.removeEventListener(Pe, vt), n.style.overflowY = "auto"
            }
        },
        yt = (e, t) => { Pe && ue(t) ? (e.style.overflowY = "hidden", t.addEventListener(Pe, vt)) : e.style.overflowY = "auto" },
        wt = (e, t, n) => { gt(), t && "hidden" !== n && pt(), setTimeout(() => { e.scrollTop = 0 }) },
        Ct = (e, t, n) => { u(e, n.showClass.backdrop), t.style.setProperty("opacity", "0", "important"), d(t, "grid"), setTimeout(() => { u(t, n.showClass.popup), t.style.removeProperty("opacity") }, bt), u([document.documentElement, document.body], p.shown), n.heightAuto && n.backdrop && !n.toast && u([document.documentElement, document.body], p["height-auto"]) },
        kt = e => {
            let t = g();
            t || new vn, t = g();
            var n = R();
            if (Z()) h(j());
            else {
                var o = t;
                const i = U(),
                    a = R();
                !e && se(V()) && (e = V());
                d(i), e && (h(e), a.setAttribute("data-button-to-replace", e.className));
                a.parentNode.insertBefore(a, e), u([o, i], p.loading)
            }
            d(n), t.setAttribute("data-loading", !0), t.setAttribute("aria-busy", !0), t.focus()
        },
        At = (t, n) => {
            const o = g(),
                i = e => Bt[n.input](o, xt(e), n);
            C(n.inputOptions) || A(n.inputOptions) ? (kt(V()), k(n.inputOptions).then(e => { t.hideLoading(), i(e) })) : "object" == typeof n.inputOptions ? i(n.inputOptions) : y("Unexpected type of inputOptions! Expected object, Map or Promise, got ".concat(typeof n.inputOptions))
        },
        Pt = (t, n) => {
            const o = t.getInput();
            h(o), k(n.inputValue).then(e => { o.value = "number" === n.input ? parseFloat(e) || 0 : "".concat(e), d(o), o.focus(), t.hideLoading() }).catch(e => { y("Error in inputValue promise: ".concat(e)), o.value = "", d(o), o.focus(), t.hideLoading() })
        },
        Bt = {
            select: (e, t, i) => {
                const a = oe(e, p.select),
                    r = (e, t, n) => {
                        const o = document.createElement("option");
                        o.value = n, l(o, t), o.selected = Et(n, i.inputValue), e.appendChild(o)
                    };
                t.forEach(e => {
                    var t = e[0];
                    const n = e[1];
                    if (Array.isArray(n)) {
                        const o = document.createElement("optgroup");
                        o.label = t, o.disabled = !1, a.appendChild(o), n.forEach(e => r(o, e[1], e[0]))
                    } else r(a, n, t)
                }), a.focus()
            },
            radio: (e, t, a) => {
                const r = oe(e, p.radio),
                    n = (t.forEach(e => {
                        var t = e[0],
                            e = e[1];
                        const n = document.createElement("input"),
                            o = document.createElement("label"),
                            i = (n.type = "radio", n.name = p.radio, n.value = t, Et(t, a.inputValue) && (n.checked = !0), document.createElement("span"));
                        l(i, e), i.className = p.label, o.appendChild(n), o.appendChild(i), r.appendChild(o)
                    }), r.querySelectorAll("input"));
                n.length && n[0].focus()
            }
        },
        xt = n => { const o = []; return "undefined" != typeof Map && n instanceof Map ? n.forEach((e, t) => { let n = e; "object" == typeof n && (n = xt(n)), o.push([t, n]) }) : Object.keys(n).forEach(e => { let t = n[e]; "object" == typeof t && (t = xt(t)), o.push([e, t]) }), o },
        Et = (e, t) => t && t.toString() === e.toString(),
        Tt = (e, t) => {
            var n = b.innerParams.get(e);
            if (!n.input) return y('The "input" parameter is needed to be set when using returnInputValueOn'.concat(v(t)));
            var o = ((e, t) => {
                const n = e.getInput();
                if (!n) return null;
                switch (t.input) {
                    case "checkbox":
                        return n.checked ? 1 : 0;
                    case "radio":
                        return (o = n).checked ? o.value : null;
                    case "file":
                        return (o = n).files.length ? null !== o.getAttribute("multiple") ? o.files : o.files[0] : null;
                    default:
                        return t.inputAutoTrim ? n.value.trim() : n.value
                }
                var o
            })(e, n);
            if (n.inputValidator) {
                var i = e;
                var a = o;
                var r = t;
                const s = b.innerParams.get(i),
                    c = (i.disableInput(), Promise.resolve().then(() => k(s.inputValidator(a, s.validationMessage))));
                c.then(e => { i.enableButtons(), i.enableInput(), e ? i.showValidationMessage(e) : ("deny" === r ? St : jt)(i, a) })
            } else e.getInput().checkValidity() ? ("deny" === t ? St : jt)(e, o) : (e.enableButtons(), e.showValidationMessage(n.validationMessage))
        },
        St = (t, n) => {
            const e = b.innerParams.get(t || void 0);
            if (e.showLoaderOnDeny && kt(N()), e.preDeny) {
                b.awaitingPromise.set(t || void 0, !0);
                const o = Promise.resolve().then(() => k(e.preDeny(n, e.validationMessage)));
                o.then(e => {!1 === e ? t.hideLoading() : t.closePopup({ isDenied: !0, value: void 0 === e ? n : e }) }).catch(e => Ot(t || void 0, e))
            } else t.closePopup({ isDenied: !0, value: n })
        },
        Lt = (e, t) => { e.closePopup({ isConfirmed: !0, value: t }) },
        Ot = (e, t) => { e.rejectPromise(t) },
        jt = (t, n) => {
            const e = b.innerParams.get(t || void 0);
            if (e.showLoaderOnConfirm && kt(), e.preConfirm) {
                t.resetValidationMessage(), b.awaitingPromise.set(t || void 0, !0);
                const o = Promise.resolve().then(() => k(e.preConfirm(n, e.validationMessage)));
                o.then(e => { se(q()) || !1 === e ? t.hideLoading() : Lt(t, void 0 === e ? n : e) }).catch(e => Ot(t || void 0, e))
            } else Lt(t, n)
        },
        Mt = (n, e, o) => {
            e.popup.onclick = () => {
                var e, t = b.innerParams.get(n);
                t && ((e = t).showConfirmButton || e.showDenyButton || e.showCancelButton || e.showCloseButton || t.timer || t.input) || o($e.close)
            }
        };
    let Dt = !1;
    const It = t => { t.popup.onmousedown = () => { t.container.onmouseup = function(e) { t.container.onmouseup = void 0, e.target === t.container && (Dt = !0) } } },
        Ht = t => { t.container.onmousedown = () => { t.popup.onmouseup = function(e) { t.popup.onmouseup = void 0, e.target !== t.popup && !t.popup.contains(e.target) || (Dt = !0) } } },
        qt = (n, o, i) => {
            o.container.onclick = e => {
                var t = b.innerParams.get(n);
                Dt ? Dt = !1 : e.target === o.container && w(t.allowOutsideClick) && i($e.backdrop)
            }
        };
    const Vt = () => V() && V().click();
    const Nt = (e, t, n) => {
            const o = K();
            if (o.length) return (t += n) === o.length ? t = 0 : -1 === t && (t = o.length - 1), o[t].focus();
            g().focus()
        },
        Rt = ["ArrowRight", "ArrowDown"],
        Ft = ["ArrowLeft", "ArrowUp"],
        Ut = (e, n, o) => {
            var i = b.innerParams.get(e);
            if (i)
                if (i.stopKeydownPropagation && n.stopPropagation(), "Enter" === n.key) e = e, a = n, t = i, w(t.allowEnterKey) && !a.isComposing && a.target && e.getInput() && a.target.outerHTML === e.getInput().outerHTML && (["textarea", "file"].includes(t.input) || (Vt(), a.preventDefault()));
                else if ("Tab" !== n.key) {
                if ([...Rt, ...Ft].includes(n.key)) {
                    e = n.key;
                    const s = V(),
                        c = N(),
                        d = F();
                    if ([s, c, d].includes(document.activeElement)) {
                        var t = Rt.includes(e) ? "nextElementSibling" : "previousElementSibling";
                        const l = document.activeElement[t];
                        l instanceof HTMLElement && l.focus()
                    }
                } else if ("Escape" === n.key) {
                    var a = n,
                        e = i;
                    if (w(e.allowEscapeKey)) {
                        a.preventDefault();
                        o($e.esc)
                    }
                }
            } else {
                e = n;
                o = i;
                var u = e.target,
                    r = K();
                let t = -1;
                for (let e = 0; e < r.length; e++)
                    if (u === r[e]) { t = e; break }
                e.shiftKey ? Nt(o, t, -1) : Nt(o, t, 1);
                e.stopPropagation(), e.preventDefault()
            }
        },
        Wt = e => "object" == typeof e && e.jquery,
        zt = e => e instanceof Element || Wt(e);
    const _t = () => {
            if (f.timeout) {
                {
                    const n = z();
                    var e = parseInt(window.getComputedStyle(n).width),
                        t = (n.style.removeProperty("transition"), n.style.width = "100%", parseInt(window.getComputedStyle(n).width)),
                        e = e / t * 100;
                    n.style.removeProperty("transition"), n.style.width = "".concat(e, "%")
                }
                return f.timeout.stop()
            }
        },
        Kt = () => { var e; if (f.timeout) return e = f.timeout.start(), J(e), e };
    let Yt = !1;
    const Zt = {};
    const Jt = t => {
        for (let e = t.target; e && e !== document; e = e.parentNode)
            for (const o in Zt) { var n = e.getAttribute(o); if (n) return void Zt[o].fire({ template: n }) }
    };
    e = Object.freeze({
        isValidParameter: B,
        isUpdatableParameter: x,
        isDeprecatedParameter: E,
        argsToParams: n => { const o = {}; return "object" != typeof n[0] || zt(n[0]) ? ["title", "html", "icon"].forEach((e, t) => { t = n[t]; "string" == typeof t || zt(t) ? o[e] = t : void 0 !== t && y("Unexpected type of ".concat(e, '! Expected "string" or "Element", got ').concat(typeof t)) }) : Object.assign(o, n[0]), o },
        isVisible: () => se(g()),
        clickConfirm: Vt,
        clickDeny: () => N() && N().click(),
        clickCancel: () => F() && F().click(),
        getContainer: m,
        getPopup: g,
        getTitle: M,
        getHtmlContainer: D,
        getImage: I,
        getIcon: j,
        getInputLabel: () => O(p["input-label"]),
        getCloseButton: _,
        getActions: U,
        getConfirmButton: V,
        getDenyButton: N,
        getCancelButton: F,
        getLoader: R,
        getFooter: W,
        getTimerProgressBar: z,
        getFocusableElements: K,
        getValidationMessage: q,
        isLoading: () => g().hasAttribute("data-loading"),
        fire: function() { for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n]; return new this(...t) },
        mixin: function(n) { class e extends this { _main(e, t) { return super._main(e, Object.assign({}, n, t)) } } return e },
        showLoading: kt,
        enableLoading: kt,
        getTimerLeft: () => f.timeout && f.timeout.getTimerLeft(),
        stopTimer: _t,
        resumeTimer: Kt,
        toggleTimer: () => { var e = f.timeout; return e && (e.running ? _t : Kt)() },
        increaseTimer: e => { if (f.timeout) return e = f.timeout.increase(e), J(e, !0), e },
        isTimerRunning: () => f.timeout && f.timeout.isRunning(),
        bindClickHandler: function() {
            var e = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : "data-swal-template";
            Zt[e] = this, Yt || (document.body.addEventListener("click", Jt), Yt = !0)
        }
    });

    function Xt() {
        var e, t = b.innerParams.get(this);
        if (t) {
            const n = b.domCache.get(this);
            h(n.loader), Z() ? t.icon && d(j()) : (t = n, (e = t.popup.getElementsByClassName(t.loader.getAttribute("data-button-to-replace"))).length ? d(e[0], "inline-block") : ce() && h(t.actions)), ne([n.popup, n.actions], p.loading), n.popup.removeAttribute("aria-busy"), n.popup.removeAttribute("data-loading"), n.confirmButton.disabled = !1, n.denyButton.disabled = !1, n.cancelButton.disabled = !1
        }
    }
    var $t = { swalPromiseResolve: new WeakMap, swalPromiseReject: new WeakMap };

    function Gt(e, t, n, o) { Z() ? nn(e, o) : (ge(n).then(() => nn(e, o)), f.keydownTarget.removeEventListener("keydown", f.keydownHandler, { capture: f.keydownListenerCapture }), f.keydownHandlerAdded = !1), /^((?!chrome|android).)*safari/i.test(navigator.userAgent) ? (t.setAttribute("style", "display:none !important"), t.removeAttribute("class"), t.innerHTML = "") : t.remove(), Y() && (mt(), ft(), Qe()), ne([document.documentElement, document.body], [p.shown, p["height-auto"], p["no-backdrop"], p["toast-shown"]]) }

    function Qt(e) {
        e = void 0 !== (n = e) ? Object.assign({ isConfirmed: !1, isDenied: !1, isDismissed: !1 }, n) : { isConfirmed: !1, isDenied: !1, isDismissed: !0 };
        const t = $t.swalPromiseResolve.get(this);
        var n = (e => {
            const t = g();
            if (!t) return false;
            const n = b.innerParams.get(e);
            if (!n || $(t, n.hideClass.popup)) return false;
            ne(t, n.showClass.popup), u(t, n.hideClass.popup);
            const o = m();
            return ne(o, n.showClass.backdrop), u(o, n.hideClass.backdrop), tn(e, t, n), true
        })(this);
        this.isAwaitingPromise() ? e.isDismissed || (en(this), t(e)) : n && t(e)
    }
    const en = e => { e.isAwaitingPromise() && (b.awaitingPromise.delete(e), b.innerParams.get(e) || e._destroy()) },
        tn = (e, t, n) => {
            var o, i, a, r = m(),
                s = Pe && ue(t);
            "function" == typeof n.willClose && n.willClose(t), s ? (s = e, o = t, t = r, i = n.returnFocus, a = n.didClose, f.swalCloseEventFinishedCallback = Gt.bind(null, s, t, i, a), o.addEventListener(Pe, function(e) { e.target === o && (f.swalCloseEventFinishedCallback(), delete f.swalCloseEventFinishedCallback) })) : Gt(e, r, n.returnFocus, n.didClose)
        },
        nn = (e, t) => { setTimeout(() => { "function" == typeof t && t.bind(e.params)(), e._destroy() }) };

    function on(e, t, n) {
        const o = b.domCache.get(e);
        t.forEach(e => { o[e].disabled = n })
    }

    function an(e, t) {
        if (!e) return !1;
        if ("radio" === e.type) {
            const n = e.parentNode.parentNode,
                o = n.querySelectorAll("input");
            for (let e = 0; e < o.length; e++) o[e].disabled = t
        } else e.disabled = t
    }
    const rn = e => { e.isAwaitingPromise() ? (sn(b, e), b.awaitingPromise.set(e, !0)) : (sn($t, e), sn(b, e)) },
        sn = (e, t) => { for (const n in e) e[n].delete(t) };
    var cn = Object.freeze({
        hideLoading: Xt,
        disableLoading: Xt,
        getInput: function(e) { var t = b.innerParams.get(e || this); return (e = b.domCache.get(e || this)) ? Q(e.popup, t.input) : null },
        close: Qt,
        isAwaitingPromise: function() { return !!b.awaitingPromise.get(this) },
        rejectPromise: function(e) {
            const t = $t.swalPromiseReject.get(this);
            en(this), t && t(e)
        },
        closePopup: Qt,
        closeModal: Qt,
        closeToast: Qt,
        enableButtons: function() { on(this, ["confirmButton", "denyButton", "cancelButton"], !1) },
        disableButtons: function() { on(this, ["confirmButton", "denyButton", "cancelButton"], !0) },
        enableInput: function() { return an(this.getInput(), !1) },
        disableInput: function() { return an(this.getInput(), !0) },
        showValidationMessage: function(e) {
            const t = b.domCache.get(this);
            var n = b.innerParams.get(this);
            l(t.validationMessage, e), t.validationMessage.className = p["validation-message"], n.customClass && n.customClass.validationMessage && u(t.validationMessage, n.customClass.validationMessage), d(t.validationMessage);
            const o = this.getInput();
            o && (o.setAttribute("aria-invalid", !0), o.setAttribute("aria-describedby", p["validation-message"]), ee(o), u(o, p.inputerror))
        },
        resetValidationMessage: function() {
            var e = b.domCache.get(this);
            e.validationMessage && h(e.validationMessage);
            const t = this.getInput();
            t && (t.removeAttribute("aria-invalid"), t.removeAttribute("aria-describedby"), ne(t, p.inputerror))
        },
        getProgressSteps: function() { return b.domCache.get(this).progressSteps },
        update: function(e) {
            var t = g(),
                n = b.innerParams.get(this);
            if (!t || $(t, n.hideClass.popup)) return a("You're trying to update the closed or closing popup, that won't work. Use the update() method in preConfirm parameter or show a new popup.");
            t = (t => {
                const n = {};
                return Object.keys(t).forEach(e => {
                    if (x(e)) n[e] = t[e];
                    else a('Invalid parameter to update: "'.concat(e, '". Updatable params are listed here: https://github.com/sweetalert2/sweetalert2/blob/master/src/utils/params.js\n\nIf you think this parameter should be updatable, request it here: https://github.com/sweetalert2/sweetalert2/issues/new?template=02_feature_request.md'))
                }), n
            })(e), n = Object.assign({}, n, t), Xe(this, n), b.innerParams.set(this, n), Object.defineProperties(this, { params: { value: Object.assign({}, this.params, e), writable: !1, enumerable: !0 } })
        },
        _destroy: function() {
            var e = b.domCache.get(this);
            const t = b.innerParams.get(this);
            t ? (e.popup && f.swalCloseEventFinishedCallback && (f.swalCloseEventFinishedCallback(), delete f.swalCloseEventFinishedCallback), f.deferDisposalTimer && (clearTimeout(f.deferDisposalTimer), delete f.deferDisposalTimer), "function" == typeof t.didDestroy && t.didDestroy(), e = this, rn(e), delete e.params, delete f.keydownHandler, delete f.keydownTarget, delete f.currentInstance) : rn(this)
        }
    });
    let ln;
    class un {
        constructor() {
            if ("undefined" != typeof window) {
                ln = this;
                for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n];
                var o = Object.freeze(this.constructor.argsToParams(t)),
                    o = (Object.defineProperties(this, { params: { value: o, writable: !1, enumerable: !0, configurable: !0 } }), this._main(this.params));
                b.promise.set(this, o)
            }
        }
        _main(e) {
            var t = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
                e = (T(Object.assign({}, t, e)), f.currentInstance && (f.currentInstance._destroy(), Y() && Qe()), f.currentInstance = this, pn(e, t)),
                t = (ut(e), Object.freeze(e), f.timeout && (f.timeout.stop(), delete f.timeout), clearTimeout(f.restoreFocusTimeout), mn(this));
            return Xe(this, e), b.innerParams.set(this, e), dn(this, t, e)
        }
        then(e) { const t = b.promise.get(this); return t.then(e) } finally(e) { const t = b.promise.get(this); return t.finally(e) }
    }
    const dn = (l, u, d) => new Promise((e, t) => {
            const n = e => { l.closePopup({ isDismissed: !0, dismiss: e }) };
            var o, i, a;
            $t.swalPromiseResolve.set(l, e), $t.swalPromiseReject.set(l, t), u.confirmButton.onclick = () => {
                var e = l,
                    t = b.innerParams.get(e);
                e.disableButtons(), t.input ? Tt(e, "confirm") : jt(e, !0)
            }, u.denyButton.onclick = () => {
                var e = l,
                    t = b.innerParams.get(e);
                e.disableButtons(), t.returnInputValueOnDeny ? Tt(e, "deny") : St(e, !1)
            }, u.cancelButton.onclick = () => {
                var e = l,
                    t = n;
                e.disableButtons(), t($e.cancel)
            }, u.closeButton.onclick = () => n($e.close), e = l, t = u, a = n, b.innerParams.get(e).toast ? Mt(e, t, a) : (It(t), Ht(t), qt(e, t, a)), o = l, e = f, t = d, i = n, e.keydownTarget && e.keydownHandlerAdded && (e.keydownTarget.removeEventListener("keydown", e.keydownHandler, { capture: e.keydownListenerCapture }), e.keydownHandlerAdded = !1), t.toast || (e.keydownHandler = e => Ut(o, e, i), e.keydownTarget = t.keydownListenerCapture ? window : g(), e.keydownListenerCapture = t.keydownListenerCapture, e.keydownTarget.addEventListener("keydown", e.keydownHandler, { capture: e.keydownListenerCapture }), e.keydownHandlerAdded = !0), a = l, "select" === (t = d).input || "radio" === t.input ? At(a, t) : ["text", "email", "number", "tel", "textarea"].includes(t.input) && (C(t.inputValue) || A(t.inputValue)) && (kt(V()), Pt(a, t)); {
                var r = d;
                const s = m(),
                    c = g();
                "function" == typeof r.willOpen && r.willOpen(c), e = window.getComputedStyle(document.body).overflowY, Ct(s, c, r), setTimeout(() => { yt(s, c) }, bt), Y() && (wt(s, r.scrollbarPadding, e), Ge()), Z() || f.previousActiveElement || (f.previousActiveElement = document.activeElement), "function" == typeof r.didOpen && setTimeout(() => r.didOpen(c)), ne(s, p["no-transition"])
            }
            gn(f, d, n), hn(u, d), setTimeout(() => { u.container.scrollTop = 0 })
        }),
        pn = (e, t) => {
            var n = (e => {
                e = "string" == typeof e.template ? document.querySelector(e.template) : e.template;
                if (!e) return {};
                e = e.content, st(e), e = Object.assign(tt(e), nt(e), ot(e), it(e), at(e), rt(e, et));
                return e
            })(e);
            const o = Object.assign({}, i, t, n, e);
            return o.showClass = Object.assign({}, i.showClass, o.showClass), o.hideClass = Object.assign({}, i.hideClass, o.hideClass), o
        },
        mn = e => { var t = { popup: g(), container: m(), actions: U(), confirmButton: V(), denyButton: N(), cancelButton: F(), loader: R(), closeButton: _(), validationMessage: q(), progressSteps: H() }; return b.domCache.set(e, t), t },
        gn = (e, t, n) => {
            var o = z();
            h(o), t.timer && (e.timeout = new dt(() => { n("timer"), delete e.timeout }, t.timer), t.timerProgressBar && (d(o), setTimeout(() => { e.timeout && e.timeout.running && J(t.timer) })))
        },
        hn = (e, t) => { if (!t.toast) return w(t.allowEnterKey) ? void(fn(e, t) || Nt(t, -1, 1)) : bn() },
        fn = (e, t) => t.focusDeny && se(e.denyButton) ? (e.denyButton.focus(), !0) : t.focusCancel && se(e.cancelButton) ? (e.cancelButton.focus(), !0) : !(!t.focusConfirm || !se(e.confirmButton)) && (e.confirmButton.focus(), !0),
        bn = () => { document.activeElement instanceof HTMLElement && "function" == typeof document.activeElement.blur && document.activeElement.blur() },
        vn = (Object.assign(un.prototype, cn), Object.assign(un, e), Object.keys(cn).forEach(e => { un[e] = function() { if (ln) return ln[e](...arguments) } }), un.DismissReason = $e, un.version = "11.3.8", un);
    return vn.default = vn, vn
}), void 0 !== this && this.Sweetalert2 && (this.swal = this.sweetAlert = this.Swal = this.SweetAlert = this.Sweetalert2);