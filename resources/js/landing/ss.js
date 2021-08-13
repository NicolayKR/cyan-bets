p.bg = m.getChildByClass(f, "pswp__bg"), M = f.className, l = !0, F = m.detectFeatures(), P = F.raf, N = F.caf, D = F.transform, H = F.oldIE, p.scrollWrap = m.getChildByClass(f, "pswp__scroll-wrap"), p.container = m.getChildByClass(p.scrollWrap, "pswp__container"), a = p.container.style, p.itemHolders = E = [{
    el: p.container.children[0],
    wrap: 0,
    index: -1
}, {
    el: p.container.children[1],
    wrap: 0,
    index: -1
}, {
    el: p.container.children[2],
    wrap: 0,
    index: -1
}], E[0].el.style.display = E[2].el.style.display = "none",
function() {
    if (D) {
        var e = F.perspective && !L;
        w = "translate" + (e ? "3d(" : "(");
        T = F.perspective ? ", 0px)" : ")";
        return
    }
    D = "left", m.addClass(f, "pswp--ie"), Oe = function(e, t) {
        t.left = e + "px"
    }, De = function(e) {
        var t = e.fitRatio > 1 ? 1 : e.fitRatio,
            n = e.container.style,
            i = t * e.w,
            o = t * e.h;
        n.width = i + "px";
        n.height = o + "px";
        n.left = e.initialPosition.x + "px";
        n.top = e.initialPosition.y + "px"
    }, Ie = function() {
        if (te) {
            var e = te,
                t = p.currItem,
                n = t.fitRatio > 1 ? 1 : t.fitRatio,
                i = n * t.w,
                o = n * t.h;
            e.width = i + "px";
            e.height = o + "px";
            e.left = de.x + "px";
            e.top = de.y + "px"
        }
    }
}(), v = {
    resize: p.updateSize,
    scroll: qe,
    keydown: Ve,
    click: ze
};
var t = F.isOldIOSPhone || F.isOldAndroid || F.isMobileOpera;
for (F.animationName && F.transform && !t || (h.showAnimationDuration = h.hideAnimationDuration = 0), e = 0; e < ye.length; e++) p["init" + ye[e]]();
if (o) {
var n = p.ui = new o(p, m);
n.init()
}
Ce("firstUpdate"), g = g || h.index || 0, (isNaN(g) || g < 0 || g >= Wt()) && (g = 0), p.currItem = Rt(g), (F.isOldIOSPhone || F.isOldAndroid) && (ve = !1), f.setAttribute("aria-hidden", "false"), h.modal && (ve ? f.style.position = "fixed" : (f.style.position = "absolute", f.style.top = m.getScrollY() + "px")), void 0 === $ && (Ce("initialLayout"), $ = j = m.getScrollY());
var i = "pswp--open ";
for (h.mainClass && (i += h.mainClass + " "), h.showHideOpacity && (i += "pswp--animate_opacity "), i += L ? "pswp--touch" : "pswp--notouch", i += F.animationName ? " pswp--css_animation" : "", i += F.svg ? " pswp--svg" : "", m.addClass(f, i), p.updateSize(), c = -1, ge = null, e = 0; e < 3; e++) Oe((e + c) * me.x, E[e].el.style);
H || m.bind(p.scrollWrap, u, p), Ee("initialZoomInEnd", function() {
p.setContent(E[0], g - 1), p.setContent(E[2], g + 1), E[0].el.style.display = E[2].el.style.display = "block", h.focus && f.focus(),
    function() {
        if (m.bind(document, "keydown", p), F.transform) {
            m.bind(p.scrollWrap, "click", p)
        }
        if (!h.mouseUsed) {
            m.bind(document, "mousemove", He)
        }
        m.bind(window, "resize scroll", p), Ce("bindEvents")
    }()
}), p.setContent(E[1], g), p.updateCurrItem(), Ce("afterInit"), ve || (x = setInterval(function() {
Ue || U || Z || y !== p.currItem.initialZoomLevel || p.updateSize()
}, 1e3)), m.addClass(f, "pswp--visible")
}
}, close: function() {
l && (s = !(l = !1), Ce("close"), function() {
    if (m.unbind(window, "resize", p), m.unbind(window, "scroll", v.scroll), m.unbind(document, "keydown", p), m.unbind(document, "mousemove", He), F.transform) {
        m.unbind(p.scrollWrap, "click", p)
    }
    if (U) {
        m.unbind(window, d, p)
    }
    Ce("unbindEvents")
}(), Vt(p.currItem, null, !0, p.destroy))
}, destroy: function() {
Ce("destroy"), jt && clearTimeout(jt), f.setAttribute("aria-hidden", "true"), f.className = M, x && clearInterval(x), m.unbind(p.scrollWrap, u, p), m.unbind(window, "scroll", p), ht(), Ke(), Se = null
}, panTo: function(e, t, n) {
n || (e > ee.min.x ? e = ee.min.x : e < ee.max.x && (e = ee.max.x), t > ee.min.y ? t = ee.min.y : t < ee.max.y && (t = ee.max.y)), de.x = e, de.y = t, Ie()
}, handleEvent: function(e) {
e = e || window.event, v[e.type] && v[e.type](e)
}, goTo: function(e) {
var t = (e = xe(e)) - g;
ge = t, g = e, p.currItem = Rt(g), pe -= t, Le(me.x * pe), Ke(), ne = !1, p.updateCurrItem()
}, next: function() {
p.goTo(g + 1)
}, prev: function() {
p.goTo(g - 1)
}, updateCurrZoomItem: function(e) {
if (e && Ce("beforeChange", 0), E[1].el.children.length) {
    var t = E[1].el.children[0];
    te = m.hasClass(t, "pswp__zoom-wrap") ? t.style : null
} else te = null;
ee = p.currItem.bounds, b = y = p.currItem.initialZoomLevel, de.x = ee.center.x, de.y = ee.center.y, e && Ce("afterChange")
}, invalidateCurrItems: function() {
S = !0;
for (var e = 0; e < 3; e++) E[e].item && (E[e].item.needsUpdate = !0)
}, updateCurrItem: function(e) {
if (0 !== ge) {
    var t, n = Math.abs(ge);
    if (!(e && n < 2)) {
        p.currItem = Rt(g), we = !1, Ce("beforeChange", ge), 3 <= n && (c += ge + (0 < ge ? -3 : 3), n = 3);
        for (var i = 0; i < n; i++) 0 < ge ? (t = E.shift(), E[2] = t, Oe((++c + 2) * me.x, t.el.style), p.setContent(t, g - n + i + 1 + 1)) : (t = E.pop(), E.unshift(t), Oe(--c * me.x, t.el.style), p.setContent(t, g + n - i - 1 - 1));
        if (te && 1 === Math.abs(ge)) {
            var o = Rt(C);
            o.initialZoomLevel !== y && (Ut(o, fe), Qt(o), De(o))
        }
        ge = 0, p.updateCurrZoomItem(), C = g, Ce("afterChange")
    }
}
}, updateSize: function(e) {
if (!ve && h.modal) {
    var t = m.getScrollY();
    if ($ !== t && (f.style.top = t + "px", $ = t), !e && be.x === window.innerWidth && be.y === window.innerHeight) return;
    be.x = window.innerWidth, be.y = window.innerHeight, f.style.height = be.y + "px"
}
if (fe.x = p.scrollWrap.clientWidth, fe.y = p.scrollWrap.clientHeight, qe(), me.x = fe.x + Math.round(fe.x * h.spacing), me.y = fe.y, Le(me.x * pe), Ce("beforeResize"), void 0 !== c) {
    for (var n, i, o, r = 0; r < 3; r++) n = E[r], Oe((r + c) * me.x, n.el.style), o = g + r - 1, h.loop && 2 < Wt() && (o = xe(o)), (i = Rt(o)) && (S || i.needsUpdate || !i.bounds) ? (p.cleanSlide(i), p.setContent(n, o), 1 === r && (p.currItem = i, p.updateCurrZoomItem(!0)), i.needsUpdate = !1) : -1 === n.index && 0 <= o && p.setContent(n, o), i && i.container && (Ut(i, fe), Qt(i), De(i));
    S = !1
}
b = y = p.currItem.initialZoomLevel, (ee = p.currItem.bounds) && (de.x = ee.center.x, de.y = ee.center.y, Ie(!0)), Ce("resize")
}, zoomTo: function(t, e, n, i, o) {
e && (b = y, dt.x = Math.abs(e.x) - de.x, dt.y = Math.abs(e.y) - de.y, Ne(ue, de));
var r = $e(t, !1),
    s = {};
We("x", r, s, t), We("y", r, s, t);
var a = y,
    l = {
        x: de.x,
        y: de.y
    };
Me(s);
var c = function(e) {
    1 === e ? (y = t, de.x = s.x, de.y = s.y) : (y = (t - a) * e + a, de.x = (s.x - l.x) * e + l.x, de.y = (s.y - l.y) * e + l.y), o && o(e), Ie(1 === e)
};
n ? Qe("customZoomTo", 0, 1, n, i || m.easing.sine.inOut, c) : c(1)
}
}, Ze = {}, Je = {}, et = {}, tt = {}, nt = {}, it = [], ot = {}, rt = [], st = {}, at = 0, lt = {
x: 0,
y: 0
}, ct = 0, ut = {
x: 0,
y: 0
}, dt = {
x: 0,
y: 0
}, ft = {
x: 0,
y: 0
}, pt = function(e, t) {
return st.x = Math.abs(e.x - t.x), st.y = Math.abs(e.y - t.y), Math.sqrt(st.x * st.x + st.y * st.y)
}, ht = function() {
n && (N(n), n = null)
}, mt = function() {
U && (n = P(mt), It())
}, gt = function(e, t) {
return !(!e || e === document) && (!(e.getAttribute("class") && -1 < e.getAttribute("class").indexOf("pswp__scroll-wrap")) && (t(e) ? e : gt(e.parentNode, t)))
}, vt = {}, yt = function(e, t) {
return vt.prevent = !gt(e.target, h.isClickableElement), Ce("preventDragEvent", e, t, vt), vt.prevent
}, bt = function(e, t) {
return t.x = e.pageX, t.y = e.pageY, t.id = e.identifier, t
}, wt = function(e, t, n) {
n.x = .5 * (e.x + t.x), n.y = .5 * (e.y + t.y)
}, Tt = function() {
var e = de.y - p.currItem.initialPosition.y;
return 1 - Math.abs(e / (fe.y / 2))
}, xt = {}, St = {}, Et = [], Ct = function(e) {
for (; 0 < Et.length;) Et.pop();
return O ? (le = 0, it.forEach(function(e) {
    0 === le ? Et[0] = e : 1 === le && (Et[1] = e), le++
})) : -1 < e.type.indexOf("touch") ? e.touches && 0 < e.touches.length && (Et[0] = bt(e.touches[0], xt), 1 < e.touches.length && (Et[1] = bt(e.touches[1], St))) : (xt.x = e.pageX, xt.y = e.pageY, xt.id = "", Et[0] = xt), Et
}, _t = function(e, t) {
var n, i, o, r, s = de[e] + t[e],
    a = 0 < t[e],
    l = ut.x + t.x,
    c = ut.x - ot.x;
if (n = s > ee.min[e] || s < ee.max[e] ? h.panEndFriction : 1, s = de[e] + t[e] * n, (h.allowPanToNext || y === p.currItem.initialZoomLevel) && (te ? "h" !== ie || "x" !== e || Y || (a ? (s > ee.min[e] && (n = h.panEndFriction, ee.min[e] - s, i = ee.min[e] - ue[e]), (i <= 0 || c < 0) && 1 < Wt() ? (r = l, c < 0 && l > ot.x && (r = ot.x)) : ee.min.x !== ee.max.x && (o = s)) : (s < ee.max[e] && (n = h.panEndFriction, s - ee.max[e], i = ue[e] - ee.max[e]), (i <= 0 || 0 < c) && 1 < Wt() ? (r = l, 0 < c && l < ot.x && (r = ot.x)) : ee.min.x !== ee.max.x && (o = s))) : r = l, "x" === e)) return void 0 !== r && (Le(r, !0), Q = r !== ot.x), ee.min.x !== ee.max.x && (void 0 !== o ? de.x = o : Q || (de.x += t.x * n)), void 0 !== r;
ne || Q || y > p.currItem.fitRatio && (de[e] += t[e] * n)
}, kt = function(e) {
if (!("mousedown" === e.type && 0 < e.button))
    if (Ft) e.preventDefault();
    else if (!B || "mousedown" !== e.type) {
    if (yt(e, !0) && e.preventDefault(), Ce("pointerDown"), O) {
        var t = m.arraySearch(it, e.pointerId, "id");
        t < 0 && (t = it.length), it[t] = {
            x: e.pageX,
            y: e.pageY,
            id: e.pointerId
        }
    }
    var n = Ct(e),
        i = n.length;
    X = null, Ke(), U && 1 !== i || (U = oe = !0, m.bind(window, d, p), z = ae = re = q = Q = K = G = Y = !1, ie = null, Ce("firstTouchStart", n), Ne(ue, de), ce.x = ce.y = 0, Ne(tt, n[0]), Ne(nt, tt), ot.x = me.x * pe, rt = [{
        x: tt.x,
        y: tt.y
    }], W = R = _e(), $e(y, !0), ht(), mt()), !Z && 1 < i && !ne && !Q && (b = y, Z = G = !(Y = !1), ce.y = ce.x = 0, Ne(ue, de), Ne(Ze, n[0]), Ne(Je, n[1]), wt(Ze, Je, ft), dt.x = Math.abs(ft.x) - de.x, dt.y = Math.abs(ft.y) - de.y, J = pt(Ze, Je))
}
}, At = function(e) {
if (e.preventDefault(), O) {
    var t = m.arraySearch(it, e.pointerId, "id");
    if (-1 < t) {
        var n = it[t];
        n.x = e.pageX, n.y = e.pageY
    }
}
if (U) {
    var i = Ct(e);
    if (ie || K || Z) X = i;
    else if (ut.x !== me.x * pe) ie = "h";
    else {
        var o = Math.abs(i[0].x - tt.x) - Math.abs(i[0].y - tt.y);
        10 <= Math.abs(o) && (ie = 0 < o ? "h" : "v", X = i)
    }
}
}, It = function() {
if (X) {
    var e = X.length;
    if (0 !== e)
        if (Ne(Ze, X[0]), et.x = Ze.x - tt.x, et.y = Ze.y - tt.y, Z && 1 < e) {
            if (tt.x = Ze.x, tt.y = Ze.y, !et.x && !et.y && function(e, t) {
                    return e.x === t.x && e.y === t.y
                }(X[1], Je)) return;
            Ne(Je, X[1]), Y || (Y = !0, Ce("zoomGestureStarted"));
            var t = pt(Ze, Je),
                n = Nt(t);
            n > p.currItem.initialZoomLevel + p.currItem.initialZoomLevel / 15 && (ae = !0);
            var i = 1,
                o = Fe(),
                r = Re();
            if (n < o)
                if (h.pinchToClose && !ae && b <= p.currItem.initialZoomLevel) {
                    var s = o - n,
                        a = 1 - s / (o / 1.2);
                    ke(a), Ce("onPinchClose", a), re = !0
                } else 1 < (i = (o - n) / o) && (i = 1), n = o - i * (o / 3);
            else r < n && (1 < (i = (n - r) / (6 * o)) && (i = 1), n = r + i * o);
            i < 0 && (i = 0), t, wt(Ze, Je, lt), ce.x += lt.x - ft.x, ce.y += lt.y - ft.y, Ne(ft, lt), de.x = Pe("x", n), de.y = Pe("y", n), z = y < n, y = n, Ie()
        } else {
            if (!ie) return;
            if (oe && (oe = !1, 10 <= Math.abs(et.x) && (et.x -= X[0].x - nt.x), 10 <= Math.abs(et.y) && (et.y -= X[0].y - nt.y)), tt.x = Ze.x, tt.y = Ze.y, 0 === et.x && 0 === et.y) return;
            if ("v" === ie && h.closeOnVerticalDrag && "fit" === h.scaleMode && y === p.currItem.initialZoomLevel) {
                ce.y += et.y, de.y += et.y;
                var l = Tt();
                return q = !0, Ce("onVerticalDrag", l), ke(l), void Ie()
            }! function(e, t, n) {
                if (e - W > 50) {
                    var i = rt.length > 2 ? rt.shift() : {};
                    i.x = t;
                    i.y = n;
                    rt.push(i);
                    W = e
                }
            }(_e(), Ze.x, Ze.y), K = !0, ee = p.currItem.bounds;
            var c = _t("x", et);
            c || (_t("y", et), Me(de), Ie())
        }
}
}, Dt = function(e) {
if (F.isOldAndroid) {
    if (B && "mouseup" === e.type) return; - 1 < e.type.indexOf("touch") && (clearTimeout(B), B = setTimeout(function() {
        B = 0
    }, 600))
}
var t;
if (Ce("pointerUp"), yt(e, !1) && e.preventDefault(), O) {
    var n = m.arraySearch(it, e.pointerId, "id");
    if (-1 < n)
        if (t = it.splice(n, 1)[0], navigator.pointerEnabled) t.type = e.pointerType || "mouse";
        else {
            t.type = {
                4: "mouse",
                2: "touch",
                3: "pen"
            } [e.pointerType], t.type || (t.type = e.pointerType || "mouse")
        }
}
var i, o = Ct(e),
    r = o.length;
if ("mouseup" === e.type && (r = 0), 2 === r) return !(X = null);
1 === r && Ne(nt, o[0]), 0 !== r || ie || ne || (t || ("mouseup" === e.type ? t = {
    x: e.pageX,
    y: e.pageY,
    type: "mouse"
} : e.changedTouches && e.changedTouches[0] && (t = {
    x: e.changedTouches[0].pageX,
    y: e.changedTouches[0].pageY,
    type: "touch"
})), Ce("touchRelease", e, t));
var s = -1;
if (0 === r && (U = !1, m.unbind(window, d, p), ht(), Z ? s = 0 : -1 !== ct && (s = _e() - ct)), ct = 1 === r ? _e() : -1, i = -1 !== s && s < 150 ? "zoom" : "swipe", Z && r < 2 && (Z = !1, 1 === r && (i = "zoomPointerUp"), Ce("zoomGestureEnded")), X = null, K || Y || ne || q)
    if (Ke(), V || (V = Ot()), V.calculateSwipeSpeed("x"), q) {
        var a = Tt();
        if (a < h.verticalDragRange) p.close();
        else {
            var l = de.y,
                c = se;
            Qe("verticalDrag", 0, 1, 300, m.easing.cubic.out, function(e) {
                de.y = (p.currItem.initialPosition.y - l) * e + l, ke((1 - c) * e + c), Ie()
            }), Ce("onVerticalDrag", 1)
        }
    } else {
        if ((Q || ne) && 0 === r) {
            var u = Pt(i, V);
            if (u) return;
            i = "zoomPointerUp"
        }
        ne || ("swipe" === i ? !Q && y > p.currItem.fitRatio && Lt(V) : Mt())
    }
}, Ot = function() {
var t, n, i = {
    lastFlickOffset: {},
    lastFlickDist: {},
    lastFlickSpeed: {},
    slowDownRatio: {},
    slowDownRatioReverse: {},
    speedDecelerationRatio: {},
    speedDecelerationRatioAbs: {},
    distanceOffset: {},
    backAnimDestination: {},
    backAnimStarted: {},
    calculateSwipeSpeed: function(e) {
        n = 1 < rt.length ? (t = _e() - W + 50, rt[rt.length - 2][e]) : (t = _e() - R, nt[e]), i.lastFlickOffset[e] = tt[e] - n, i.lastFlickDist[e] = Math.abs(i.lastFlickOffset[e]), 20 < i.lastFlickDist[e] ? i.lastFlickSpeed[e] = i.lastFlickOffset[e] / t : i.lastFlickSpeed[e] = 0, Math.abs(i.lastFlickSpeed[e]) < .1 && (i.lastFlickSpeed[e] = 0), i.slowDownRatio[e] = .95, i.slowDownRatioReverse[e] = 1 - i.slowDownRatio[e], i.speedDecelerationRatio[e] = 1
    },
    calculateOverBoundsAnimOffset: function(t, e) {
        i.backAnimStarted[t] || (de[t] > ee.min[t] ? i.backAnimDestination[t] = ee.min[t] : de[t] < ee.max[t] && (i.backAnimDestination[t] = ee.max[t]), void 0 !== i.backAnimDestination[t] && (i.slowDownRatio[t] = .7, i.slowDownRatioReverse[t] = 1 - i.slowDownRatio[t], i.speedDecelerationRatioAbs[t] < .05 && (i.lastFlickSpeed[t] = 0, i.backAnimStarted[t] = !0, Qe("bounceZoomPan" + t, de[t], i.backAnimDestination[t], e || 300, m.easing.sine.out, function(e) {
            de[t] = e, Ie()
        }))))
    },
    calculateAnimOffset: function(e) {
        i.backAnimStarted[e] || (i.speedDecelerationRatio[e] = i.speedDecelerationRatio[e] * (i.slowDownRatio[e] + i.slowDownRatioReverse[e] - i.slowDownRatioReverse[e] * i.timeDiff / 10), i.speedDecelerationRatioAbs[e] = Math.abs(i.lastFlickSpeed[e] * i.speedDecelerationRatio[e]), i.distanceOffset[e] = i.lastFlickSpeed[e] * i.speedDecelerationRatio[e] * i.timeDiff, de[e] += i.distanceOffset[e])
    },
    panAnimLoop: function() {
        if (Be.zoomPan && (Be.zoomPan.raf = P(i.panAnimLoop), i.now = _e(), i.timeDiff = i.now - i.lastNow, i.lastNow = i.now, i.calculateAnimOffset("x"), i.calculateAnimOffset("y"), Ie(), i.calculateOverBoundsAnimOffset("x"), i.calculateOverBoundsAnimOffset("y"), i.speedDecelerationRatioAbs.x < .05 && i.speedDecelerationRatioAbs.y < .05)) return de.x = Math.round(de.x), de.y = Math.round(de.y), Ie(), void Ge("zoomPan")
    }
};
return i
}, Lt = function(e) {
if (e.calculateSwipeSpeed("y"), ee = p.currItem.bounds, e.backAnimDestination = {}, e.backAnimStarted = {}, Math.abs(e.lastFlickSpeed.x) <= .05 && Math.abs(e.lastFlickSpeed.y) <= .05) return e.speedDecelerationRatioAbs.x = e.speedDecelerationRatioAbs.y = 0, e.calculateOverBoundsAnimOffset("x"), e.calculateOverBoundsAnimOffset("y"), !0;
Ye("zoomPan"), e.lastNow = _e(), e.panAnimLoop()
}, Pt = function(e, t) {
var n, i, o;
if (ne || (at = g), "swipe" === e) {
    var r = tt.x - nt.x,
        s = t.lastFlickDist.x < 10;
    30 < r && (s || 20 < t.lastFlickOffset.x) ? i = -1 : r < -30 && (s || t.lastFlickOffset.x < -20) && (i = 1)
}
i && ((g += i) < 0 ? (g = h.loop ? Wt() - 1 : 0, o = !0) : g >= Wt() && (g = h.loop ? 0 : Wt() - 1, o = !0), o && !h.loop || (ge += i, pe -= i, n = !0));
var a, l = me.x * pe,
    c = Math.abs(l - ut.x);
return a = n || l > ut.x == 0 < t.lastFlickSpeed.x ? (a = 0 < Math.abs(t.lastFlickSpeed.x) ? c / Math.abs(t.lastFlickSpeed.x) : 333, a = Math.min(a, 400), Math.max(a, 250)) : 333, at === g && (n = !1), ne = !0, Ce("mainScrollAnimStart"), Qe("mainScroll", ut.x, l, a, m.easing.cubic.out, Le, function() {
    Ke(), ne = !1, at = -1, !n && at === g || p.updateCurrItem(), Ce("mainScrollAnimComplete")
}), n && p.updateCurrItem(!0), n
}, Nt = function(e) {
return 1 / J * e * b
}, Mt = function() {
var e = y,
    t = Fe(),
    n = Re();
y < t ? e = t : n < y && (e = n);
var i, o = se;
return re && !z && !ae && y < t ? p.close() : (re && (i = function(e) {
    ke((1 - o) * e + o)
}), p.zoomTo(e, 0, 200, m.easing.cubic.out, i)), !0
};
Te("Gestures", {
publicMethods: {
    initGestures: function() {
        var e = function(e, t, n, i, o) {
            _ = e + t, k = e + n, A = e + i, I = o ? e + o : ""
        };
        (O = F.pointerEvent) && F.touch && (F.touch = !1), O ? navigator.pointerEnabled ? e("pointer", "down", "move", "up", "cancel") : e("MSPointer", "Down", "Move", "Up", "Cancel") : F.touch ? (e("touch", "start", "move", "end", "cancel"), L = !0) : e("mouse", "down", "move", "up"), d = k + " " + A + " " + I, u = _, O && !L && (L = 1 < navigator.maxTouchPoints || 1 < navigator.msMaxTouchPoints), p.likelyTouchDevice = L, v[_] = kt, v[k] = At, v[A] = Dt, I && (v[I] = v[A]), F.touch && (u += " mousedown", d += " mousemove mouseup", v.mousedown = v[_], v.mousemove = v[k], v.mouseup = v[A]), L || (h.allowPanToNext = !1)
    }
}
});
var jt, Ht, $t, Ft, Rt, Wt, Vt = function(a, e, l, t) {
    var c;
    jt && clearTimeout(jt), $t = Ft = !0, a.initialLayout ? (c = a.initialLayout, a.initialLayout = null) : c = h.getThumbBoundsFn && h.getThumbBoundsFn(g);
    var u = l ? h.hideAnimationDuration : h.showAnimationDuration,
        d = function() {
            Ge("initialZoom"), l ? (p.template.removeAttribute("style"), p.bg.removeAttribute("style")) : (ke(1), e && (e.style.display = "block"), m.addClass(f, "pswp--animated-in"), Ce("initialZoom" + (l ? "OutEnd" : "InEnd"))), t && t(), Ft = !1
        };
    if (!u || !c || void 0 === c.x) return Ce("initialZoom" + (l ? "Out" : "In")), y = a.initialZoomLevel, Ne(de, a.initialPosition), Ie(), f.style.opacity = l ? 0 : 1, ke(1), void(u ? setTimeout(function() {
        d()
    }, u) : d());
    ! function() {
        var r = i,
            s = !p.currItem.src || p.currItem.loadError || h.showHideOpacity;
        if (a.miniImg) {
            a.miniImg.style.webkitBackfaceVisibility = "hidden"
        }
        if (!l) {
            y = c.w / a.w;
            de.x = c.x;
            de.y = c.y - j;
            p[s ? "template" : "bg"].style.opacity = .001;
            Ie()
        }
        if (Ye("initialZoom"), l && !r) {
            m.removeClass(f, "pswp--animated-in")
        }
        if (s) {
            if (l) {
                m[(r ? "remove" : "add") + "Class"](f, "pswp--animate_opacity")
            } else {
                setTimeout(function() {
                    m.addClass(f, "pswp--animate_opacity")
                }, 30)
            }
        }
        jt = setTimeout(function() {
            Ce("initialZoom" + (l ? "Out" : "In"));
            if (!l) {
                y = a.initialZoomLevel;
                Ne(de, a.initialPosition);
                Ie();
                ke(1);
                if (s) {
                    f.style.opacity = 1
                } else {
                    ke(1)
                }
                jt = setTimeout(d, u + 20)
            } else {
                var t = c.w / a.w,
                    n = {
                        x: de.x,
                        y: de.y
                    },
                    i = y,
                    o = se,
                    e = function(e) {
                        if (e === 1) {
                            y = t;
                            de.x = c.x;
                            de.y = c.y - $
                        } else {
                            y = (t - i) * e + i;
                            de.x = (c.x - n.x) * e + n.x;
                            de.y = (c.y - $ - n.y) * e + n.y
                        }
                        Ie();
                        if (s) {
                            f.style.opacity = 1 - e
                        } else {
                            ke(o - e * o)
                        }
                    };
                if (r) {
                    Qe("initialZoom", 0, 1, u, m.easing.cubic.out, e, d)
                } else {
                    e(1);
                    jt = setTimeout(d, u + 20)
                }
            }
        }, l ? 25 : 90)
    }()
},
zt = {},
qt = [],
Bt = {
    index: 0,
    errorMsg: '<div class="pswp__error-msg"><a href="%url%" target="_blank">The image</a> could not be loaded.</div>',
    forceProgressiveLoading: !1,
    preload: [1, 1],
    getNumItemsFn: function() {
        return Ht.length
    }
},
Ut = function(e, t, n) {
    if (!e.src || e.loadError) return e.w = e.h = 0, e.initialZoomLevel = e.fitRatio = 1, e.bounds = {
        center: {
            x: 0,
            y: 0
        },
        max: {
            x: 0,
            y: 0
        },
        min: {
            x: 0,
            y: 0
        }
    }, e.initialPosition = e.bounds.center, e.bounds;
    var i = !n;
    if (i && (e.vGap || (e.vGap = {
            top: 0,
            bottom: 0
        }), Ce("parseVerticalMargin", e)), zt.x = t.x, zt.y = t.y - e.vGap.top - e.vGap.bottom, i) {
        var o = zt.x / e.w,
            r = zt.y / e.h;
        e.fitRatio = o < r ? o : r;
        var s = h.scaleMode;
        "orig" === s ? n = 1 : "fit" === s && (n = e.fitRatio), 1 < n && (n = 1), e.initialZoomLevel = n, e.bounds || (e.bounds = {
            center: {
                x: 0,
                y: 0
            },
            max: {
                x: 0,
                y: 0
            },
            min: {
                x: 0,
                y: 0
            }
        })
    }
    return n ? (function(e, t, n) {
        var i = e.bounds;
        i.center.x = Math.round((zt.x - t) / 2), i.center.y = Math.round((zt.y - n) / 2) + e.vGap.top, i.max.x = t > zt.x ? Math.round(zt.x - t) : i.center.x, i.max.y = n > zt.y ? Math.round(zt.y - n) + e.vGap.top : i.center.y, i.min.x = t > zt.x ? 0 : i.center.x, i.min.y = n > zt.y ? e.vGap.top : i.center.y
    }(e, e.w * n, e.h * n), i && n === e.initialZoomLevel && (e.initialPosition = e.bounds.center), e.bounds) : void 0
},
Gt = function(e, t, n, i, o, r) {
    t.loadError || i && (t.imageAppended = !0, Qt(t, i, t === p.currItem && we), n.appendChild(i), r && setTimeout(function() {
        t && t.loaded && t.placeholder && (t.placeholder.style.display = "none", t.placeholder = null)
    }, 500))
},
Yt = function(e) {
    e.loading = !0, e.loaded = !1;
    var t = e.img = m.createEl("pswp__img", "img"),
        n = function() {
            e.loading = !1, e.loaded = !0, e.loadComplete ? e.loadComplete(e) : e.img = null, t.onload = t.onerror = null, t = null
        };
    return t.onload = n, t.onerror = function() {
        e.loadError = !0, n()
    }, t.src = e.src, t
},
Kt = function(e, t) {
    if (e.src && e.loadError && e.container) return t && (e.container.innerHTML = ""), e.container.innerHTML = h.errorMsg.replace("%url%", e.src), !0
},
Qt = function(e, t, n) {
    if (e.src) {
        t || (t = e.container.lastChild);
        var i = n ? e.w : Math.round(e.w * e.fitRatio),
            o = n ? e.h : Math.round(e.h * e.fitRatio);
        e.placeholder && !e.loaded && (e.placeholder.style.width = i + "px", e.placeholder.style.height = o + "px"), t.style.width = i + "px", t.style.height = o + "px"
    }
},
Xt = function() {
    if (qt.length) {
        for (var e, t = 0; t < qt.length; t++)(e = qt[t]).holder.index === e.index && Gt(e.index, e.item, e.baseDiv, e.img, !1, e.clearPlaceholder);
        qt = []
    }
};
Te("Controller", {
publicMethods: {
    lazyLoadItem: function(e) {
        e = xe(e);
        var t = Rt(e);
        t && (!t.loaded && !t.loading || S) && (Ce("gettingData", e, t), t.src && Yt(t))
    },
    initController: function() {
        m.extend(h, Bt, !0), p.items = Ht = e, Rt = p.getItemAt, Wt = h.getNumItemsFn, h.loop, Wt() < 3 && (h.loop = !1), Ee("beforeChange", function(e) {
            var t, n = h.preload,
                i = null === e || 0 <= e,
                o = Math.min(n[0], Wt()),
                r = Math.min(n[1], Wt());
            for (t = 1; t <= (i ? r : o); t++) p.lazyLoadItem(g + t);
            for (t = 1; t <= (i ? o : r); t++) p.lazyLoadItem(g - t)
        }), Ee("initialLayout", function() {
            p.currItem.initialLayout = h.getThumbBoundsFn && h.getThumbBoundsFn(g)
        }), Ee("mainScrollAnimComplete", Xt), Ee("initialZoomInEnd", Xt), Ee("destroy", function() {
            for (var e, t = 0; t < Ht.length; t++)(e = Ht[t]).container && (e.container = null), e.placeholder && (e.placeholder = null), e.img && (e.img = null), e.preloader && (e.preloader = null), e.loadError && (e.loaded = e.loadError = !1);
            qt = null
        })
    },
    getItemAt: function(e) {
        return 0 <= e && (void 0 !== Ht[e] && Ht[e])
    },
    allowProgressiveImg: function() {
        return h.forceProgressiveLoading || !L || h.mouseUsed || 1200 < screen.width
    },
    setContent: function(t, n) {
        h.loop && (n = xe(n));
        var e = p.getItemAt(t.index);
        e && (e.container = null);
        var i, o = p.getItemAt(n);
        if (o) {
            Ce("gettingData", n, o), t.index = n;
            var r = (t.item = o).container = m.createEl("pswp__zoom-wrap");
            if (!o.src && o.html && (o.html.tagName ? r.appendChild(o.html) : r.innerHTML = o.html), Kt(o), Ut(o, fe), !o.src || o.loadError || o.loaded) o.src && !o.loadError && ((i = m.createEl("pswp__img", "img")).style.opacity = 1, i.src = o.src, Qt(o, i), Gt(n, o, r, i, !0));
            else {
                if (o.loadComplete = function(e) {
                        if (l) {
                            if (t && t.index === n) {
                                if (Kt(e, !0)) return e.loadComplete = e.img = null, Ut(e, fe), De(e), void(t.index === g && p.updateCurrZoomItem());
                                e.imageAppended ? !Ft && e.placeholder && (e.placeholder.style.display = "none", e.placeholder = null) : F.transform && (ne || Ft) ? qt.push({
                                    item: e,
                                    baseDiv: r,
                                    img: e.img,
                                    index: n,
                                    holder: t,
                                    clearPlaceholder: !0
                                }) : Gt(n, e, r, e.img, ne || Ft, !0)
                            }
                            e.loadComplete = null, e.img = null, Ce("imageLoadComplete", n, e)
                        }
                    }, m.features.transform) {
                    var s = "pswp__img pswp__img--placeholder";
                    s += o.msrc ? "" : " pswp__img--placeholder--blank";
                    var a = m.createEl(s, o.msrc ? "img" : "");
                    o.msrc && (a.src = o.msrc), Qt(o, a), r.appendChild(a), o.placeholder = a
                }
                o.loading || Yt(o), p.allowProgressiveImg() && (!$t && F.transform ? qt.push({
                    item: o,
                    baseDiv: r,
                    img: o.img,
                    index: n,
                    holder: t
                }) : Gt(n, o, r, o.img, !0, !0))
            }
            $t || n !== g ? De(o) : (te = r.style, Vt(o, i || o.img)), t.el.innerHTML = "", t.el.appendChild(r)
        } else t.el.innerHTML = ""
    },
    cleanSlide: function(e) {
        e.img && (e.img.onload = e.img.onerror = null), e.loaded = e.loading = e.img = e.imageAppended = !1
    }
}
});
var Zt, Jt, en = {},
tn = function(e, t, n) {
    var i = document.createEvent("CustomEvent"),
        o = {
            origEvent: e,
            target: e.target,
            releasePoint: t,
            pointerType: n || "touch"
        };
    i.initCustomEvent("pswpTap", !0, !0, o), e.target.dispatchEvent(i)
};
Te("Tap", {
publicMethods: {
    initTap: function() {
        Ee("firstTouchStart", p.onTapStart), Ee("touchRelease", p.onTapRelease), Ee("destroy", function() {
            en = {}, Zt = null
        })
    },
    onTapStart: function(e) {
        1 < e.length && (clearTimeout(Zt), Zt = null)
    },
    onTapRelease: function(e, t) {
        if (t && !K && !G && !Ue) {
            var n = t;
            if (Zt && (clearTimeout(Zt), Zt = null, function(e, t) {
                    return Math.abs(e.x - t.x) < r && Math.abs(e.y - t.y) < r
                }(n, en))) return void Ce("doubleTap", n);
            if ("mouse" === t.type) return void tn(e, t, "mouse");
            var i = e.target.tagName.toUpperCase();
            if ("BUTTON" === i || m.hasClass(e.target, "pswp__single-tap")) return void tn(e, t);
            Ne(en, n), Zt = setTimeout(function() {
                tn(e, t), Zt = null
            }, 300)
        }
    }
}
}), Te("DesktopZoom", {
publicMethods: {
    initDesktopZoom: function() {
        H || (L ? Ee("mouseUsed", function() {
            p.setupDesktopZoom()
        }) : p.setupDesktopZoom(!0))
    },
    setupDesktopZoom: function(e) {
        Jt = {};
        var t = "wheel mousewheel DOMMouseScroll";
        Ee("bindEvents", function() {
            m.bind(f, t, p.handleMouseWheel)
        }), Ee("unbindEvents", function() {
            Jt && m.unbind(f, t, p.handleMouseWheel)
        }), p.mouseZoomedIn = !1;
        var n, i = function() {
                p.mouseZoomedIn && (m.removeClass(f, "pswp--zoomed-in"), p.mouseZoomedIn = !1), y < 1 ? m.addClass(f, "pswp--zoom-allowed") : m.removeClass(f, "pswp--zoom-allowed"), o()
            },
            o = function() {
                n && (m.removeClass(f, "pswp--dragging"), n = !1)
            };
        Ee("resize", i), Ee("afterChange", i), Ee("pointerDown", function() {
            p.mouseZoomedIn && (n = !0, m.addClass(f, "pswp--dragging"))
        }), Ee("pointerUp", o), e || i()
    },
    handleMouseWheel: function(e) {
        if (y <= p.currItem.fitRatio) return h.modal && (!h.closeOnScroll || Ue || U ? e.preventDefault() : D && 2 < Math.abs(e.deltaY) && (i = !0, p.close())), !0;
        if (e.stopPropagation(), Jt.x = 0, "deltaX" in e) 1 === e.deltaMode ? (Jt.x = 18 * e.deltaX, Jt.y = 18 * e.deltaY) : (Jt.x = e.deltaX, Jt.y = e.deltaY);
        else if ("wheelDelta" in e) e.wheelDeltaX && (Jt.x = -.16 * e.wheelDeltaX), e.wheelDeltaY ? Jt.y = -.16 * e.wheelDeltaY : Jt.y = -.16 * e.wheelDelta;
        else {
            if (!("detail" in e)) return;
            Jt.y = e.detail
        }
        $e(y, !0);
        var t = de.x - Jt.x,
            n = de.y - Jt.y;
        (h.modal || t <= ee.min.x && t >= ee.max.x && n <= ee.min.y && n >= ee.max.y) && e.preventDefault(), p.panTo(t, n)
    },
    toggleDesktopZoom: function(e) {
        e = e || {
            x: fe.x / 2 + he.x,
            y: fe.y / 2 + he.y
        };
        var t = h.getDoubleTapZoom(!0, p.currItem),
            n = y === t;
        p.mouseZoomedIn = !n, p.zoomTo(n ? p.currItem.initialZoomLevel : t, e, 333), m[(n ? "remove" : "add") + "Class"](f, "pswp--zoomed-in")
    }
}
});
var nn, on, rn, sn, an, ln, cn, un, dn, fn, pn, hn, mn = {
    history: !0,
    galleryUID: 1
},
gn = function() {
    return pn.hash.substring(1)
},
vn = function() {
    nn && clearTimeout(nn), rn && clearTimeout(rn)
},
yn = function() {
    var e = gn(),
        t = {};
    if (e.length < 5) return t;
    var n, i = e.split("&");
    for (n = 0; n < i.length; n++)
        if (i[n]) {
            var o = i[n].split("=");
            o.length < 2 || (t[o[0]] = o[1])
        } if (h.galleryPIDs) {
        var r = t.pid;
        for (t.pid = 0, n = 0; n < Ht.length; n++)
            if (Ht[n].pid === r) {
                t.pid = n;
                break
            }
    } else t.pid = parseInt(t.pid, 10) - 1;
    return t.pid < 0 && (t.pid = 0), t
},
bn = function() {
    if (rn && clearTimeout(rn), Ue || U) rn = setTimeout(bn, 500);
    else {
        sn ? clearTimeout(on) : sn = !0;
        var e = g + 1,
            t = Rt(g);
        t.hasOwnProperty("pid") && (e = t.pid);
        var n = cn + "&gid=" + h.galleryUID + "&pid=" + e;
        un || -1 === pn.hash.indexOf(n) && (fn = !0);
        var i = pn.href.split("#")[0] + "#" + n;
        hn ? "#" + n !== window.location.hash && history[un ? "replaceState" : "pushState"]("", document.title, i) : un ? pn.replace(i) : pn.hash = n, un = !0, on = setTimeout(function() {
            sn = !1
        }, 60)
    }
};
Te("History", {
publicMethods: {
initHistory: function() {
    if (m.extend(h, mn, !0), h.history) {
        pn = window.location, un = dn = fn = !1, cn = gn(), hn = "pushState" in history, -1 < cn.indexOf("gid=") && (cn = (cn = cn.split("&gid=")[0]).split("?gid=")[0]), Ee("afterChange", p.updateURL), Ee("unbindEvents", function() {
            m.unbind(window, "hashchange", p.onHashChange)
        });
        var e = function() {
            ln = !0, dn || (fn ? history.back() : cn ? pn.hash = cn : hn ? history.pushState("", document.title, pn.pathname + pn.search) : pn.hash = ""), vn()
        };
        Ee("unbindEvents", function() {
            i && e()
        }), Ee("destroy", function() {
            ln || e()
        }), Ee("firstUpdate", function() {
            g = yn().pid
        });
        var t = cn.indexOf("pid="); - 1 < t && "&" === (cn = cn.substring(0, t)).slice(-1) && (cn = cn.slice(0, -1)), setTimeout(function() {
            l && m.bind(window, "hashchange", p.onHashChange)
        }, 40)
    }
},
onHashChange: function() {
    if (gn() === cn) return dn = !0, void p.close();
    sn || (an = !0, p.goTo(yn().pid), an = !1)
},
updateURL: function() {
    vn(), an || (un ? nn = setTimeout(bn, 800) : bn())
}
}
}), m.extend(p, Xe)
}
}) ? o.call(n, i, n, t): o) || (t.exports = r)
}, {}], 2: [function(e, t, n) {
"use strict";
Object.defineProperty(n, "__esModule", {
    value: !0
}), n.PhotoSwipe = n.default = void 0;
var p = i(e("photoswipe")),
    h = i(e("./libs/photoswipe-ui-default"));

function i(e) {
    return e && e.__esModule ? e : {
        default: e
    }
}

function o(c) {
    var s = c('<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true"><div class="pswp__bg"></div><div class="pswp__scroll-wrap"><div class="pswp__container"><div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><div class="pswp__ui pswp__ui--hidden"><div class="pswp__top-bar"><div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button> <button class="pswp__button pswp__button--share" title="Share"></button> <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button><div class="pswp__preloader"><div class="pswp__preloader__icn"><div class="pswp__preloader__cut"><div class="pswp__preloader__donut"></div></div></div></div></div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"><div class="pswp__share-tooltip"></div></div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button> <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button><div class="pswp__caption"><div class="pswp__caption__center"></div></div></div></div></div>').appendTo("body"),
        l = 1;

    function u(e) {
        var t = a(e).slideSelector;
        return e.find(t).map(function(e) {
            var t = c(this).data("index", e),
                n = this.tagName.toUpperCase();
            return "A" === n ? this.hash ? t = c(this.hash) : (t = t.find("img").eq(0)).data("original-src", this.href) : "IMG" !== n && (t = t.find("img")), t[0]
        })
    }

    function t(e, t) {
        var n = c.Deferred(),
            i = t.data("original-src-" + e),
            o = decodeURI(t.data("original-src") || t.attr("src")).match(/(\d+)[*Г—x](\d+)/);
        return i ? n.resolve(i) : null !== o ? n.resolve(o["width" === e ? 1 : 2]) : c("<img>").on("load", function() {
            n.resolve(this[e])
        }).attr("src", t.attr("src")), n.promise()
    }

    function e(e) {
        return c.when(function(e) {
            return t("width", e)
        }(e), function(e) {
            return t("height", e)
        }(e))
    }

    function i() {
        var s = c(this),
            a = s.data("original-src") || s.attr("src"),
            l = c.Deferred();
        return "IMG" !== this.tagName ? l.resolve({
            html: this.innerHTML
        }) : e(s).done(function(e, t) {
            var n, i, o, r = s.attr("src");
            n = (i = s.data("caption-class")) ? function e(t, n) {
                var i, o = t.parent();
                if (o.length) return (i = o.find(n)).length ? i.html() : e(o, n)
            }(s, "." + i) : (o = s.closest("figure").find("figcaption")) && o.length ? o.html() : s.attr("alt"), l.resolve({
                w: e,
                h: t,
                src: a,
                msrc: r,
                title: n
            })
        }), l.promise()
    }

    function d(e) {
        var t = e.map(i).get(),
            n = c.Deferred();
        return c.when.apply(c, t).done(function() {
            var e = Array.prototype.slice.call(arguments);
            n.resolve(e)
        }), n.promise()
    }

    function a(e) {
        return e.data("photoswipeOptions")
    }

    function r(e, t, n, i) {
        var o = c.extend(a(t).globalOptions, {
                index: e,
                getThumbBoundsFn: function(o) {
                    return function(e) {
                        var t = o.eq(e),
                            n = t.offset(),
                            i = t[0].width;
                        return {
                            x: n.left,
                            y: n.top,
                            w: i
                        }
                    }
                }(n),
                galleryUID: t.data("pswp-uid")
            }),
            r = new p.default(s[0], h.default, i, o);
        c.each(a(t).events, function(e, t) {
            r.listen(e, t)
        }), r.init()
    }

    function n(e) {
        var t, n, i, o = function() {
            var e = window.location.hash.substring(1),
                t = {};
            if (e.length < 5) return t;
            for (var n = e.split("&"), i = 0; i < n.length; i++)
                if (n[i]) {
                    var o = n[i].split("=");
                    o.length < 2 || (t[o[0]] = parseInt(o[1], 10))
                } return t
        }();
        o.pid && o.gid && (t = e[o.gid - 1], n = o.pid - 1, d(i = u(t)).done(function(e) {
            r(n, t, i, e)
        }))
    }

    function f(t, n, i) {
        t.on("click.photoswipe", a(t).slideSelector, function(e) {
            e.preventDefault(), r(c(this).data("index"), t, n, i)
        })
    }
    c.fn.photoSwipe = function() {
        var i = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : "img",
            e = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : {},
            o = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {},
            r = c.extend({
                bgOpacity: .973,
                showHideOpacity: !0
            }, e),
            s = [],
            a = "update" === i;
        return this.each(function() {
            if (a) ! function(t) {
                var n = u(t);
                d(n).done(function(e) {
                    ! function(e) {
                        e.off("click.photoswipe")
                    }(t), f(t, n, e)
                })
            }(c(this));
            else {
                var t = c(this).data("photoswipeOptions", {
                        slideSelector: i,
                        globalOptions: r,
                        events: o
                    }),
                    n = u(t),
                    e = d(n);
                ! function(e) {
                    e.data("pswp-uid") || e.data("pswp-uid", l++)
                }(t), s.push(t), e.done(function(e) {
                    f(t, n, e)
                })
            }
        }), a || n(s), this
    }, c.fn.photoSwipe.PhotoSwipe = p.default
}
o(jQuery), n.default = o, n.PhotoSwipe = p.default
}, {
"./libs/photoswipe-ui-default": 3,
photoswipe: 1
}], 3: [function(e, t, n) {
"use strict";
"function" == typeof Symbol && Symbol.iterator;
/*! PhotoSwipe Default UI - 4.1.1 - 2015-12-24
 * http://photoswipe.com
 * Copyright (c) 2015 Dmitry Semenov; */
void 0 === (r = "function" == typeof(o = function() {
    return function(o, l) {
        var t, c, r, s, n, i, a, u, d, e, f, p, h, m, g, v, y, b, w = this,
            T = !1,
            x = !0,
            S = !0,
            E = {
                barsSize: {
                    top: 44,
                    bottom: "auto"
                },
                closeElClasses: ["item", "caption", "zoom-wrap", "ui", "top-bar"],
                timeToIdle: 4e3,
                timeToIdleOutside: 1e3,
                loadingIndicatorDelay: 1e3,
                addCaptionHTMLFn: function(e, t) {
                    return e.title ? (t.children[0].innerHTML = e.title, !0) : (t.children[0].innerHTML = "", !1)
                },
                closeEl: !0,
                captionEl: !0,
                fullscreenEl: !0,
                zoomEl: !0,
                shareEl: !0,
                counterEl: !0,
                arrowEl: !0,
                preloaderEl: !0,
                tapToClose: !1,
                tapToToggleControls: !0,
                clickToCloseNonZoomable: !0,
                shareButtons: [{
                    id: "facebook",
                    label: "Share on Facebook",
                    url: "https://www.facebook.com/sharer/sharer.php?u={{url}}"
                }, {
                    id: "twitter",
                    label: "Tweet",
                    url: "https://twitter.com/intent/tweet?text={{text}}&url={{url}}"
                }, {
                    id: "pinterest",
                    label: "Pin it",
                    url: "http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}"
                }, {
                    id: "download",
                    label: "Download image",
                    url: "{{raw_image_url}}",
                    download: !0
                }],
                getImageURLForShare: function() {
                    return o.currItem.src || ""
                },
                getPageURLForShare: function() {
                    return window.location.href
                },
                getTextForShare: function() {
                    return o.currItem.title || ""
                },
                indexIndicatorSep: " / ",
                fitControlsWidth: 1200
            },
            C = function(e) {
                if (v) return !0;
                e = e || window.event, g.timeToIdle && g.mouseUsed && !d && N();
                for (var t, n, i = e.target || e.srcElement, o = i.getAttribute("class") || "", r = 0; r < $.length; r++)(t = $[r]).onTap && -1 < o.indexOf("pswp__" + t.name) && (t.onTap(), n = !0);
                if (n) {
                    e.stopPropagation && e.stopPropagation(), v = !0;
                    var s = l.features.isOldAndroid ? 600 : 30;
                    setTimeout(function() {
                        v = !1
                    }, s)
                }
            },
            _ = function(e, t, n) {
                l[(n ? "add" : "remove") + "Class"](e, "pswp__" + t)
            },
            k = function() {
                var e = 1 === g.getNumItemsFn();
                e !== m && (_(c, "ui--one-slide", e), m = e)
            },
            A = function() {
                _(a, "share-modal--hidden", S)
            },
            I = function() {
                return (S = !S) ? (l.removeClass(a, "pswp__share-modal--fade-in"), setTimeout(function() {
                    S && A()
                }, 300)) : (A(), setTimeout(function() {
                    S || l.addClass(a, "pswp__share-modal--fade-in")
                }, 30)), S || O(), !1
            },
            D = function(e) {
                var t = (e = e || window.event).target || e.srcElement;
                return o.shout("shareLinkClick", e, t), !!t.href && (!!t.hasAttribute("download") || (window.open(t.href, "pswp_share", "scrollbars=yes,resizable=yes,toolbar=no,location=yes,width=550,height=420,top=100,left=" + (window.screen ? Math.round(screen.width / 2 - 275) : 100)), S || I(), !1))
            },
            O = function() {
                for (var e, t, n, i, o, r = "", s = 0; s < g.shareButtons.length; s++) e = g.shareButtons[s], n = g.getImageURLForShare(e), i = g.getPageURLForShare(e), o = g.getTextForShare(e), t = e.url.replace("{{url}}", encodeURIComponent(i)).replace("{{image_url}}", encodeURIComponent(n)).replace("{{raw_image_url}}", n).replace("{{text}}", encodeURIComponent(o)), r += '<a href="' + t + '" target="_blank" class="pswp__share--' + e.id + '"' + (e.download ? "download" : "") + ">" + e.label + "</a>", g.parseShareButtonOut && (r = g.parseShareButtonOut(e, r));
                a.children[0].innerHTML = r, a.children[0].onclick = D
            },
            L = function(e) {
                for (var t = 0; t < g.closeElClasses.length; t++)
                    if (l.hasClass(e, "pswp__" + g.closeElClasses[t])) return !0
            },
            P = 0,
            N = function() {
                clearTimeout(b), P = 0, d && w.setIdle(!1)
            },
            M = function(e) {
                var t = (e = e || window.event).relatedTarget || e.toElement;
                t && "HTML" !== t.nodeName || (clearTimeout(b), b = setTimeout(function() {
                    w.setIdle(!0)
                }, g.timeToIdleOutside))
            },
            j = function(e) {
                p !== e && (_(f, "preloader--active", !e), p = e)
            },
            H = function(e) {
                var t = e.vGap;
                if (function() {
                        return !o.likelyTouchDevice || g.mouseUsed || screen.width > g.fitControlsWidth
                    }()) {
                    var n = g.barsSize;
                    if (g.captionEl && "auto" === n.bottom)
                        if (s || ((s = l.createEl("pswp__caption pswp__caption--fake")).appendChild(l.createEl("pswp__caption__center")), c.insertBefore(s, r), l.addClass(c, "pswp__ui--fit")), g.addCaptionHTMLFn(e, s, !0)) {
                            var i = s.clientHeight;
                            t.bottom = parseInt(i, 10) || 44
                        } else t.bottom = n.top;
                    else t.bottom = "auto" === n.bottom ? 0 : n.bottom;
                    t.top = n.top
                } else t.top = t.bottom = 0
            },
            $ = [{
                name: "caption",
                option: "captionEl",
                onInit: function(e) {
                    r = e
                }
            }, {
                name: "share-modal",
                option: "shareEl",
                onInit: function(e) {
                    a = e
                },
                onTap: function() {
                    I()
                }
            }, {
                name: "button--share",
                option: "shareEl",
                onInit: function(e) {
                    i = e
                },
                onTap: function() {
                    I()
                }
            }, {
                name: "button--zoom",
                option: "zoomEl",
                onTap: o.toggleDesktopZoom
            }, {
                name: "counter",
                option: "counterEl",
                onInit: function(e) {
                    n = e
                }
            }, {
                name: "button--close",
                option: "closeEl",
                onTap: o.close
            }, {
                name: "button--arrow--left",
                option: "arrowEl",
                onTap: o.prev
            }, {
                name: "button--arrow--right",
                option: "arrowEl",
                onTap: o.next
            }, {
                name: "button--fs",
                option: "fullscreenEl",
                onTap: function() {
                    t.isFullscreen() ? t.exit() : t.enter()
                }
            }, {
                name: "preloader",
                option: "preloaderEl",
                onInit: function(e) {
                    f = e
                }
            }];
        w.init = function() {
            l.extend(o.options, E, !0), g = o.options, c = l.getChildByClass(o.scrollWrap, "pswp__ui"), e = o.listen,
                function() {
                    var t;
                    e("onVerticalDrag", function(e) {
                        if (x && e < .95) {
                            w.hideControls()
                        } else if (!x && e >= .95) {
                            w.showControls()
                        }
                    }), e("onPinchClose", function(e) {
                        if (x && e < .9) {
                            w.hideControls();
                            t = true
                        } else if (t && !x && e > .9) {
                            w.showControls()
                        }
                    }), e("zoomGestureEnded", function() {
                        t = false;
                        if (t && !x) {
                            w.showControls()
                        }
                    })
                }(), e("beforeChange", w.update), e("doubleTap", function(e) {
                    var t = o.currItem.initialZoomLevel;
                    o.getZoomLevel() !== t ? o.zoomTo(t, e, 333) : o.zoomTo(g.getDoubleTapZoom(!1, o.currItem), e, 333)
                }), e("preventDragEvent", function(e, t, n) {
                    var i = e.target || e.srcElement;
                    i && i.getAttribute("class") && -1 < e.type.indexOf("mouse") && (0 < i.getAttribute("class").indexOf("__caption") || /(SMALL|STRONG|EM)/i.test(i.tagName)) && (n.prevent = !1)
                }), e("bindEvents", function() {
                    l.bind(c, "pswpTap click", C), l.bind(o.scrollWrap, "pswpTap", w.onGlobalTap), o.likelyTouchDevice || l.bind(o.scrollWrap, "mouseover", w.onMouseOver)
                }), e("unbindEvents", function() {
                    S || I(), y && clearInterval(y), l.unbind(document, "mouseout", M), l.unbind(document, "mousemove", N), l.unbind(c, "pswpTap click", C), l.unbind(o.scrollWrap, "pswpTap", w.onGlobalTap), l.unbind(o.scrollWrap, "mouseover", w.onMouseOver), t && (l.unbind(document, t.eventK, w.updateFullscreen), t.isFullscreen() && (g.hideAnimationDuration = 0, t.exit()), t = null)
                }), e("destroy", function() {
                    g.captionEl && (s && c.removeChild(s), l.removeClass(r, "pswp__caption--empty")), a && (a.children[0].onclick = null), l.removeClass(c, "pswp__ui--over-close"), l.addClass(c, "pswp__ui--hidden"), w.setIdle(!1)
                }), g.showAnimationDuration || l.removeClass(c, "pswp__ui--hidden"), e("initialZoomIn", function() {
                    g.showAnimationDuration && l.removeClass(c, "pswp__ui--hidden")
                }), e("initialZoomOut", function() {
                    l.addClass(c, "pswp__ui--hidden")
                }), e("parseVerticalMargin", H),
                function() {
                    var r, s, a, e = function e(t) {
                        if (!t) {
                            return
                        }
                        var n = t.length;
                        for (var i = 0; i < n; i++) {
                            r = t[i];
                            s = r.className;
                            for (var o = 0; o < $.length; o++) {
                                a = $[o];
                                if (s.indexOf("pswp__" + a.name) > -1) {
                                    if (g[a.option]) {
                                        l.removeClass(r, "pswp__element--disabled");
                                        if (a.onInit) {
                                            a.onInit(r)
                                        }
                                    } else {
                                        l.addClass(r, "pswp__element--disabled")
                                    }
                                }
                            }
                        }
                    };
                    e(c.children);
                    var t = l.getChildByClass(c, "pswp__top-bar");
                    if (t) {
                        e(t.children)
                    }
                }(), g.shareEl && i && a && (S = !0), k(),
                function() {
                    if (g.timeToIdle) {
                        e("mouseUsed", function() {
                            l.bind(document, "mousemove", N);
                            l.bind(document, "mouseout", M);
                            y = setInterval(function() {
                                P++;
                                if (P === 2) {
                                    w.setIdle(true)
                                }
                            }, g.timeToIdle / 2)
                        })
                    }
                }(),
                function() {
                    if (g.fullscreenEl && !l.features.isOldAndroid) {
                        if (!t) {
                            t = w.getFullscreenAPI()
                        }
                        if (t) {
                            l.bind(document, t.eventK, w.updateFullscreen);
                            w.updateFullscreen();
                            l.addClass(o.template, "pswp--supports-fs")
                        } else {
                            l.removeClass(o.template, "pswp--supports-fs")
                        }
                    }
                }(),
                function() {
                    if (g.preloaderEl) {
                        j(true);
                        e("beforeChange", function() {
                            clearTimeout(h);
                            h = setTimeout(function() {
                                if (o.currItem && o.currItem.loading) {
                                    if (!o.allowProgressiveImg() || o.currItem.img && !o.currItem.img.naturalWidth) {
                                        j(false)
                                    }
                                } else {
                                    j(true)
                                }
                            }, g.loadingIndicatorDelay)
                        });
                        e("imageLoadComplete", function(e, t) {
                            if (o.currItem === t) {
                                j(true)
                            }
                        })
                    }
                }()
        }, w.setIdle = function(e) {
            _(c, "ui--idle", d = e)
        }, w.update = function() {
            T = !(!x || !o.currItem) && (w.updateIndexIndicator(), g.captionEl && (g.addCaptionHTMLFn(o.currItem, r), _(r, "caption--empty", !o.currItem.title)), !0), S || I(), k()
        }, w.updateFullscreen = function(e) {
            e && setTimeout(function() {
                o.setScrollOffset(0, l.getScrollY())
            }, 50), l[(t.isFullscreen() ? "add" : "remove") + "Class"](o.template, "pswp--fs")
        }, w.updateIndexIndicator = function() {
            g.counterEl && (n.innerHTML = o.getCurrentIndex() + 1 + g.indexIndicatorSep + g.getNumItemsFn())
        }, w.onGlobalTap = function(e) {
            var t = (e = e || window.event).target || e.srcElement;
            if (!v)
                if (e.detail && "mouse" === e.detail.pointerType) {
                    if (L(t)) return void o.close();
                    l.hasClass(t, "pswp__img") && (1 === o.getZoomLevel() && o.getZoomLevel() <= o.currItem.fitRatio ? g.clickToCloseNonZoomable && o.close() : o.toggleDesktopZoom(e.detail.releasePoint))
                } else if (g.tapToToggleControls && (x ? w.hideControls() : w.showControls()), g.tapToClose && (l.hasClass(t, "pswp__img") || L(t))) return void o.close()
        }, w.onMouseOver = function(e) {
            var t = (e = e || window.event).target || e.srcElement;
            _(c, "ui--over-close", L(t))
        }, w.hideControls = function() {
            l.addClass(c, "pswp__ui--hidden"), x = !1
        }, w.showControls = function() {
            x = !0, T || w.update(), l.removeClass(c, "pswp__ui--hidden")
        }, w.supportsFullscreen = function() {
            var e = document;
            return !!(e.exitFullscreen || e.mozCancelFullScreen || e.webkitExitFullscreen || e.msExitFullscreen)
        }, w.getFullscreenAPI = function() {
            var e, t = document.documentElement,
                n = "fullscreenchange";
            return t.requestFullscreen ? e = {
                enterK: "requestFullscreen",
                exitK: "exitFullscreen",
                elementK: "fullscreenElement",
                eventK: n
            } : t.mozRequestFullScreen ? e = {
                enterK: "mozRequestFullScreen",
                exitK: "mozCancelFullScreen",
                elementK: "mozFullScreenElement",
                eventK: "moz" + n
            } : t.webkitRequestFullscreen ? e = {
                enterK: "webkitRequestFullscreen",
                exitK: "webkitExitFullscreen",
                elementK: "webkitFullscreenElement",
                eventK: "webkit" + n
            } : t.msRequestFullscreen && (e = {
                enterK: "msRequestFullscreen",
                exitK: "msExitFullscreen",
                elementK: "msFullscreenElement",
                eventK: "MSFullscreenChange"
            }), e && (e.enter = function() {
                if (u = g.closeOnScroll, g.closeOnScroll = !1, "webkitRequestFullscreen" !== this.enterK) return o.template[this.enterK]();
                o.template[this.enterK](Element.ALLOW_KEYBOARD_INPUT)
            }, e.exit = function() {
                return g.closeOnScroll = u, document[this.exitK]()
            }, e.isFullscreen = function() {
                return document[this.elementK]
            }), e
        }
    }
}) ? o.call(n, i, n, t) : o) || (t.exports = r)
}, {}]
}, {}, [2])
},
function(e, t, n) {
var s;
window.imagesLoaded = n(61), window.Shuffle = n(62), s = jQuery, page.registerVendor("Shuffle"), page.initShuffle = function() {
    if (void 0 !== window.Shuffle && 0 !== s('[data-provide="shuffle"]').length) {
        var r = window.Shuffle;
        s('[data-provide="shuffle"]').each(function() {
            var e = s(this).find('[data-shuffle="list"]'),
                t = s(this).find('[data-shuffle="filter"]'),
                n = s(this).find('[data-shuffle="search"]'),
                o = new r(e, {
                    itemSelector: '[data-shuffle="item"]',
                    sizer: '[data-shuffle="sizer"]',
                    delimeter: ",",
                    speed: 500
                });
            t.length && s(t).find('[data-shuffle="button"]').each(function() {
                s(this).on("click", function() {
                    var e, t = s(this),
                        n = t.hasClass("active"),
                        i = t.data("group");
                    n || (s(this).closest('[data-shuffle="filter"]').find('[data-shuffle="button"].active').removeClass("active"), e = n ? (t.removeClass("active"), r.ALL_ITEMS) : (t.addClass("active"), i), o.filter(e))
                })
            }), n.length && n.on("input mouseup change", function() {
                var n = s(this).val().toLowerCase();
                o.filter(function(e, t) {
                    return -1 !== e.textContent.toLowerCase().trim().indexOf(n)
                })
            }), s(this).imagesLoaded(function() {
                o.layout()
            })
        })
    }
}
},
function(e, n, t) {
var i, o, r, s;
"undefined" != typeof window && window, r = {
    id: "ev-emitter/ev-emitter",
    exports: {},
    loaded: (o = function() {
        function e() {}
        var t = e.prototype;
        return t.on = function(e, t) {
            if (e && t) {
                var n = this._events = this._events || {},
                    i = n[e] = n[e] || [];
                return -1 == i.indexOf(t) && i.push(t), this
            }
        }, t.once = function(e, t) {
            if (e && t) {
                this.on(e, t);
                var n = this._onceEvents = this._onceEvents || {};
                return (n[e] = n[e] || {})[t] = !0, this
            }
        }, t.off = function(e, t) {
            var n = this._events && this._events[e];
            if (n && n.length) {
                var i = n.indexOf(t);
                return -1 != i && n.splice(i, 1), this
            }
        }, t.emitEvent = function(e, t) {
            var n = this._events && this._events[e];
            if (n && n.length) {
                n = n.slice(0), t = t || [];
                for (var i = this._onceEvents && this._onceEvents[e], o = 0; o < n.length; o++) {
                    var r = n[o];
                    i && i[r] && (this.off(e, r), delete i[r]), r.apply(this, t)
                }
                return this
            }
        }, t.allOff = function() {
            delete this._events, delete this._onceEvents
        }, e
    }, !1)
}, i = "function" == typeof o ? o.call(r.exports, t, r.exports, r) : o, r.loaded = !0, void 0 !== i || (i = r.exports),