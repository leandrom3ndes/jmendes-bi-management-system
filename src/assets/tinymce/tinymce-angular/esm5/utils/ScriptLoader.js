/**
 * Copyright (c) 2017-present, Ephox, Inc.
 *
 * This source code is licensed under the Apache 2 license found in the
 * LICENSE file in the root directory of this source tree.
 *
 */
import { uuid } from './Utils';
var createState = function () {
    return {
        listeners: [],
        scriptId: uuid('tiny-script'),
        scriptLoaded: false
    };
};
var ɵ0 = createState;
var CreateScriptLoader = function () {
    var state = createState();
    var injectScriptTag = function (scriptId, doc, url, callback) {
        var scriptTag = doc.createElement('script');
        scriptTag.referrerPolicy = 'origin';
        scriptTag.type = 'application/javascript';
        scriptTag.id = scriptId;
        scriptTag.src = url;
        var handler = function () {
            scriptTag.removeEventListener('load', handler);
            callback();
        };
        scriptTag.addEventListener('load', handler);
        if (doc.head) {
            doc.head.appendChild(scriptTag);
        }
    };
    var load = function (doc, url, callback) {
        if (state.scriptLoaded) {
            callback();
        }
        else {
            state.listeners.push(callback);
            if (!doc.getElementById(state.scriptId)) {
                injectScriptTag(state.scriptId, doc, url, function () {
                    state.listeners.forEach(function (fn) { return fn(); });
                    state.scriptLoaded = true;
                });
            }
        }
    };
    // Only to be used by tests.
    var reinitialize = function () {
        state = createState();
    };
    return {
        load: load,
        reinitialize: reinitialize
    };
};
var ɵ1 = CreateScriptLoader;
var ScriptLoader = CreateScriptLoader();
export { ScriptLoader };
export { ɵ0, ɵ1 };
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiU2NyaXB0TG9hZGVyLmpzIiwic291cmNlUm9vdCI6Im5nOi8vQHRpbnltY2UvdGlueW1jZS1hbmd1bGFyLyIsInNvdXJjZXMiOlsidXRpbHMvU2NyaXB0TG9hZGVyLnRzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7R0FNRztBQUVILE9BQU8sRUFBRSxJQUFJLEVBQUUsTUFBTSxTQUFTLENBQUM7QUFTL0IsSUFBTSxXQUFXLEdBQUc7SUFDbEIsT0FBTztRQUNMLFNBQVMsRUFBRSxFQUFFO1FBQ2IsUUFBUSxFQUFFLElBQUksQ0FBQyxhQUFhLENBQUM7UUFDN0IsWUFBWSxFQUFFLEtBQUs7S0FDcEIsQ0FBQztBQUNKLENBQUMsQ0FBQzs7QUFPRixJQUFNLGtCQUFrQixHQUFHO0lBQ3pCLElBQUksS0FBSyxHQUFjLFdBQVcsRUFBRSxDQUFDO0lBRXJDLElBQU0sZUFBZSxHQUFHLFVBQUMsUUFBZ0IsRUFBRSxHQUFhLEVBQUUsR0FBVyxFQUFFLFFBQW9CO1FBQ3pGLElBQU0sU0FBUyxHQUFHLEdBQUcsQ0FBQyxhQUFhLENBQUMsUUFBUSxDQUFDLENBQUM7UUFDOUMsU0FBUyxDQUFDLGNBQWMsR0FBRyxRQUFRLENBQUM7UUFDcEMsU0FBUyxDQUFDLElBQUksR0FBRyx3QkFBd0IsQ0FBQztRQUMxQyxTQUFTLENBQUMsRUFBRSxHQUFHLFFBQVEsQ0FBQztRQUN4QixTQUFTLENBQUMsR0FBRyxHQUFHLEdBQUcsQ0FBQztRQUVwQixJQUFNLE9BQU8sR0FBRztZQUNkLFNBQVMsQ0FBQyxtQkFBbUIsQ0FBQyxNQUFNLEVBQUUsT0FBTyxDQUFDLENBQUM7WUFDL0MsUUFBUSxFQUFFLENBQUM7UUFDYixDQUFDLENBQUM7UUFDRixTQUFTLENBQUMsZ0JBQWdCLENBQUMsTUFBTSxFQUFFLE9BQU8sQ0FBQyxDQUFDO1FBQzVDLElBQUksR0FBRyxDQUFDLElBQUksRUFBRTtZQUNaLEdBQUcsQ0FBQyxJQUFJLENBQUMsV0FBVyxDQUFDLFNBQVMsQ0FBQyxDQUFDO1NBQ2pDO0lBQ0gsQ0FBQyxDQUFDO0lBRUYsSUFBTSxJQUFJLEdBQUcsVUFBQyxHQUFhLEVBQUUsR0FBVyxFQUFFLFFBQW9CO1FBQzVELElBQUksS0FBSyxDQUFDLFlBQVksRUFBRTtZQUN0QixRQUFRLEVBQUUsQ0FBQztTQUNaO2FBQU07WUFDTCxLQUFLLENBQUMsU0FBUyxDQUFDLElBQUksQ0FBQyxRQUFRLENBQUMsQ0FBQztZQUMvQixJQUFJLENBQUMsR0FBRyxDQUFDLGNBQWMsQ0FBQyxLQUFLLENBQUMsUUFBUSxDQUFDLEVBQUU7Z0JBQ3ZDLGVBQWUsQ0FBQyxLQUFLLENBQUMsUUFBUSxFQUFFLEdBQUcsRUFBRSxHQUFHLEVBQUU7b0JBQ3hDLEtBQUssQ0FBQyxTQUFTLENBQUMsT0FBTyxDQUFDLFVBQUMsRUFBRSxJQUFLLE9BQUEsRUFBRSxFQUFFLEVBQUosQ0FBSSxDQUFDLENBQUM7b0JBQ3RDLEtBQUssQ0FBQyxZQUFZLEdBQUcsSUFBSSxDQUFDO2dCQUM1QixDQUFDLENBQUMsQ0FBQzthQUNKO1NBQ0Y7SUFDSCxDQUFDLENBQUM7SUFFRiw0QkFBNEI7SUFDNUIsSUFBTSxZQUFZLEdBQUc7UUFDbkIsS0FBSyxHQUFHLFdBQVcsRUFBRSxDQUFDO0lBQ3hCLENBQUMsQ0FBQztJQUVGLE9BQU87UUFDTCxJQUFJLE1BQUE7UUFDSixZQUFZLGNBQUE7S0FDYixDQUFDO0FBQ0osQ0FBQyxDQUFDOztBQUVGLElBQU0sWUFBWSxHQUFHLGtCQUFrQixFQUFFLENBQUM7QUFFMUMsT0FBTyxFQUNMLFlBQVksRUFDYixDQUFDIiwic291cmNlc0NvbnRlbnQiOlsiLyoqXG4gKiBDb3B5cmlnaHQgKGMpIDIwMTctcHJlc2VudCwgRXBob3gsIEluYy5cbiAqXG4gKiBUaGlzIHNvdXJjZSBjb2RlIGlzIGxpY2Vuc2VkIHVuZGVyIHRoZSBBcGFjaGUgMiBsaWNlbnNlIGZvdW5kIGluIHRoZVxuICogTElDRU5TRSBmaWxlIGluIHRoZSByb290IGRpcmVjdG9yeSBvZiB0aGlzIHNvdXJjZSB0cmVlLlxuICpcbiAqL1xuXG5pbXBvcnQgeyB1dWlkIH0gZnJvbSAnLi9VdGlscyc7XG5cbmV4cG9ydCB0eXBlIGNhbGxiYWNrRm4gPSAoKSA9PiB2b2lkO1xuZXhwb3J0IGludGVyZmFjZSBJU3RhdGVPYmoge1xuICBsaXN0ZW5lcnM6IGNhbGxiYWNrRm5bXTtcbiAgc2NyaXB0SWQ6IHN0cmluZztcbiAgc2NyaXB0TG9hZGVkOiBib29sZWFuO1xufVxuXG5jb25zdCBjcmVhdGVTdGF0ZSA9ICgpOiBJU3RhdGVPYmogPT4ge1xuICByZXR1cm4ge1xuICAgIGxpc3RlbmVyczogW10sXG4gICAgc2NyaXB0SWQ6IHV1aWQoJ3Rpbnktc2NyaXB0JyksXG4gICAgc2NyaXB0TG9hZGVkOiBmYWxzZVxuICB9O1xufTtcblxuaW50ZXJmYWNlIFNjcmlwdExvYWRlciB7XG4gIGxvYWQ6IChkb2M6IERvY3VtZW50LCB1cmw6IHN0cmluZywgY2FsbGJhY2s6IGNhbGxiYWNrRm4pID0+IHZvaWQ7XG4gIHJlaW5pdGlhbGl6ZTogKCkgPT4gdm9pZDtcbn1cblxuY29uc3QgQ3JlYXRlU2NyaXB0TG9hZGVyID0gKCk6IFNjcmlwdExvYWRlciA9PiB7XG4gIGxldCBzdGF0ZTogSVN0YXRlT2JqID0gY3JlYXRlU3RhdGUoKTtcblxuICBjb25zdCBpbmplY3RTY3JpcHRUYWcgPSAoc2NyaXB0SWQ6IHN0cmluZywgZG9jOiBEb2N1bWVudCwgdXJsOiBzdHJpbmcsIGNhbGxiYWNrOiBjYWxsYmFja0ZuKSA9PiB7XG4gICAgY29uc3Qgc2NyaXB0VGFnID0gZG9jLmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpO1xuICAgIHNjcmlwdFRhZy5yZWZlcnJlclBvbGljeSA9ICdvcmlnaW4nO1xuICAgIHNjcmlwdFRhZy50eXBlID0gJ2FwcGxpY2F0aW9uL2phdmFzY3JpcHQnO1xuICAgIHNjcmlwdFRhZy5pZCA9IHNjcmlwdElkO1xuICAgIHNjcmlwdFRhZy5zcmMgPSB1cmw7XG5cbiAgICBjb25zdCBoYW5kbGVyID0gKCkgPT4ge1xuICAgICAgc2NyaXB0VGFnLnJlbW92ZUV2ZW50TGlzdGVuZXIoJ2xvYWQnLCBoYW5kbGVyKTtcbiAgICAgIGNhbGxiYWNrKCk7XG4gICAgfTtcbiAgICBzY3JpcHRUYWcuYWRkRXZlbnRMaXN0ZW5lcignbG9hZCcsIGhhbmRsZXIpO1xuICAgIGlmIChkb2MuaGVhZCkge1xuICAgICAgZG9jLmhlYWQuYXBwZW5kQ2hpbGQoc2NyaXB0VGFnKTtcbiAgICB9XG4gIH07XG5cbiAgY29uc3QgbG9hZCA9IChkb2M6IERvY3VtZW50LCB1cmw6IHN0cmluZywgY2FsbGJhY2s6IGNhbGxiYWNrRm4pID0+IHtcbiAgICBpZiAoc3RhdGUuc2NyaXB0TG9hZGVkKSB7XG4gICAgICBjYWxsYmFjaygpO1xuICAgIH0gZWxzZSB7XG4gICAgICBzdGF0ZS5saXN0ZW5lcnMucHVzaChjYWxsYmFjayk7XG4gICAgICBpZiAoIWRvYy5nZXRFbGVtZW50QnlJZChzdGF0ZS5zY3JpcHRJZCkpIHtcbiAgICAgICAgaW5qZWN0U2NyaXB0VGFnKHN0YXRlLnNjcmlwdElkLCBkb2MsIHVybCwgKCkgPT4ge1xuICAgICAgICAgIHN0YXRlLmxpc3RlbmVycy5mb3JFYWNoKChmbikgPT4gZm4oKSk7XG4gICAgICAgICAgc3RhdGUuc2NyaXB0TG9hZGVkID0gdHJ1ZTtcbiAgICAgICAgfSk7XG4gICAgICB9XG4gICAgfVxuICB9O1xuXG4gIC8vIE9ubHkgdG8gYmUgdXNlZCBieSB0ZXN0cy5cbiAgY29uc3QgcmVpbml0aWFsaXplID0gKCkgPT4ge1xuICAgIHN0YXRlID0gY3JlYXRlU3RhdGUoKTtcbiAgfTtcblxuICByZXR1cm4ge1xuICAgIGxvYWQsXG4gICAgcmVpbml0aWFsaXplXG4gIH07XG59O1xuXG5jb25zdCBTY3JpcHRMb2FkZXIgPSBDcmVhdGVTY3JpcHRMb2FkZXIoKTtcblxuZXhwb3J0IHtcbiAgU2NyaXB0TG9hZGVyXG59OyJdfQ==