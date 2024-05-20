import { Output, EventEmitter } from '@angular/core';
var Events = /** @class */ (function () {
    function Events() {
        this.onBeforePaste = new EventEmitter();
        this.onBlur = new EventEmitter();
        this.onClick = new EventEmitter();
        this.onContextMenu = new EventEmitter();
        this.onCopy = new EventEmitter();
        this.onCut = new EventEmitter();
        this.onDblclick = new EventEmitter();
        this.onDrag = new EventEmitter();
        this.onDragDrop = new EventEmitter();
        this.onDragEnd = new EventEmitter();
        this.onDragGesture = new EventEmitter();
        this.onDragOver = new EventEmitter();
        this.onDrop = new EventEmitter();
        this.onFocus = new EventEmitter();
        this.onFocusIn = new EventEmitter();
        this.onFocusOut = new EventEmitter();
        this.onKeyDown = new EventEmitter();
        this.onKeyPress = new EventEmitter();
        this.onKeyUp = new EventEmitter();
        this.onMouseDown = new EventEmitter();
        this.onMouseEnter = new EventEmitter();
        this.onMouseLeave = new EventEmitter();
        this.onMouseMove = new EventEmitter();
        this.onMouseOut = new EventEmitter();
        this.onMouseOver = new EventEmitter();
        this.onMouseUp = new EventEmitter();
        this.onPaste = new EventEmitter();
        this.onSelectionChange = new EventEmitter();
        this.onActivate = new EventEmitter();
        this.onAddUndo = new EventEmitter();
        this.onBeforeAddUndo = new EventEmitter();
        this.onBeforeExecCommand = new EventEmitter();
        this.onBeforeGetContent = new EventEmitter();
        this.onBeforeRenderUI = new EventEmitter();
        this.onBeforeSetContent = new EventEmitter();
        this.onChange = new EventEmitter();
        this.onClearUndos = new EventEmitter();
        this.onDeactivate = new EventEmitter();
        this.onDirty = new EventEmitter();
        this.onExecCommand = new EventEmitter();
        this.onGetContent = new EventEmitter();
        this.onHide = new EventEmitter();
        this.onInit = new EventEmitter();
        this.onInitNgModel = new EventEmitter();
        this.onLoadContent = new EventEmitter();
        this.onNodeChange = new EventEmitter();
        this.onPostProcess = new EventEmitter();
        this.onPostRender = new EventEmitter();
        this.onPreInit = new EventEmitter();
        this.onPreProcess = new EventEmitter();
        this.onProgressState = new EventEmitter();
        this.onRedo = new EventEmitter();
        this.onRemove = new EventEmitter();
        this.onReset = new EventEmitter();
        this.onSaveContent = new EventEmitter();
        this.onSetAttrib = new EventEmitter();
        this.onObjectResizeStart = new EventEmitter();
        this.onObjectResized = new EventEmitter();
        this.onObjectSelected = new EventEmitter();
        this.onSetContent = new EventEmitter();
        this.onShow = new EventEmitter();
        this.onSubmit = new EventEmitter();
        this.onUndo = new EventEmitter();
        this.onVisualAid = new EventEmitter();
    }
    Events.propDecorators = {
        onBeforePaste: [{ type: Output }],
        onBlur: [{ type: Output }],
        onClick: [{ type: Output }],
        onContextMenu: [{ type: Output }],
        onCopy: [{ type: Output }],
        onCut: [{ type: Output }],
        onDblclick: [{ type: Output }],
        onDrag: [{ type: Output }],
        onDragDrop: [{ type: Output }],
        onDragEnd: [{ type: Output }],
        onDragGesture: [{ type: Output }],
        onDragOver: [{ type: Output }],
        onDrop: [{ type: Output }],
        onFocus: [{ type: Output }],
        onFocusIn: [{ type: Output }],
        onFocusOut: [{ type: Output }],
        onKeyDown: [{ type: Output }],
        onKeyPress: [{ type: Output }],
        onKeyUp: [{ type: Output }],
        onMouseDown: [{ type: Output }],
        onMouseEnter: [{ type: Output }],
        onMouseLeave: [{ type: Output }],
        onMouseMove: [{ type: Output }],
        onMouseOut: [{ type: Output }],
        onMouseOver: [{ type: Output }],
        onMouseUp: [{ type: Output }],
        onPaste: [{ type: Output }],
        onSelectionChange: [{ type: Output }],
        onActivate: [{ type: Output }],
        onAddUndo: [{ type: Output }],
        onBeforeAddUndo: [{ type: Output }],
        onBeforeExecCommand: [{ type: Output }],
        onBeforeGetContent: [{ type: Output }],
        onBeforeRenderUI: [{ type: Output }],
        onBeforeSetContent: [{ type: Output }],
        onChange: [{ type: Output }],
        onClearUndos: [{ type: Output }],
        onDeactivate: [{ type: Output }],
        onDirty: [{ type: Output }],
        onExecCommand: [{ type: Output }],
        onGetContent: [{ type: Output }],
        onHide: [{ type: Output }],
        onInit: [{ type: Output }],
        onInitNgModel: [{ type: Output }],
        onLoadContent: [{ type: Output }],
        onNodeChange: [{ type: Output }],
        onPostProcess: [{ type: Output }],
        onPostRender: [{ type: Output }],
        onPreInit: [{ type: Output }],
        onPreProcess: [{ type: Output }],
        onProgressState: [{ type: Output }],
        onRedo: [{ type: Output }],
        onRemove: [{ type: Output }],
        onReset: [{ type: Output }],
        onSaveContent: [{ type: Output }],
        onSetAttrib: [{ type: Output }],
        onObjectResizeStart: [{ type: Output }],
        onObjectResized: [{ type: Output }],
        onObjectSelected: [{ type: Output }],
        onSetContent: [{ type: Output }],
        onShow: [{ type: Output }],
        onSubmit: [{ type: Output }],
        onUndo: [{ type: Output }],
        onVisualAid: [{ type: Output }]
    };
    return Events;
}());
export { Events };
export var validEvents = [
    'onActivate',
    'onAddUndo',
    'onBeforeAddUndo',
    'onBeforeExecCommand',
    'onBeforeGetContent',
    'onBeforeRenderUI',
    'onBeforeSetContent',
    'onBeforePaste',
    'onBlur',
    'onChange',
    'onClearUndos',
    'onClick',
    'onContextMenu',
    'onCopy',
    'onCut',
    'onDblclick',
    'onDeactivate',
    'onDirty',
    'onDrag',
    'onDragDrop',
    'onDragEnd',
    'onDragGesture',
    'onDragOver',
    'onDrop',
    'onExecCommand',
    'onFocus',
    'onFocusIn',
    'onFocusOut',
    'onGetContent',
    'onHide',
    'onInit',
    'onKeyDown',
    'onKeyPress',
    'onKeyUp',
    'onLoadContent',
    'onMouseDown',
    'onMouseEnter',
    'onMouseLeave',
    'onMouseMove',
    'onMouseOut',
    'onMouseOver',
    'onMouseUp',
    'onNodeChange',
    'onObjectResizeStart',
    'onObjectResized',
    'onObjectSelected',
    'onPaste',
    'onPostProcess',
    'onPostRender',
    'onPreProcess',
    'onProgressState',
    'onRedo',
    'onRemove',
    'onReset',
    'onSaveContent',
    'onSelectionChange',
    'onSetAttrib',
    'onSetContent',
    'onShow',
    'onSubmit',
    'onUndo',
    'onVisualAid'
];
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiRXZlbnRzLmpzIiwic291cmNlUm9vdCI6Im5nOi8vQHRpbnltY2UvdGlueW1jZS1hbmd1bGFyLyIsInNvdXJjZXMiOlsiZWRpdG9yL0V2ZW50cy50cyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSxPQUFPLEVBQUUsTUFBTSxFQUFFLFlBQVksRUFBRSxNQUFNLGVBQWUsQ0FBQztBQU9yRDtJQUFBO1FBQ21CLGtCQUFhLEdBQTJDLElBQUksWUFBWSxFQUFFLENBQUM7UUFDM0UsV0FBTSxHQUF1QyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQ2hFLFlBQU8sR0FBdUMsSUFBSSxZQUFZLEVBQUUsQ0FBQztRQUNqRSxrQkFBYSxHQUF1QyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQ3ZFLFdBQU0sR0FBMkMsSUFBSSxZQUFZLEVBQUUsQ0FBQztRQUNwRSxVQUFLLEdBQTJDLElBQUksWUFBWSxFQUFFLENBQUM7UUFDbkUsZUFBVSxHQUF1QyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQ3BFLFdBQU0sR0FBc0MsSUFBSSxZQUFZLEVBQUUsQ0FBQztRQUMvRCxlQUFVLEdBQXNDLElBQUksWUFBWSxFQUFFLENBQUM7UUFDbkUsY0FBUyxHQUFzQyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQ2xFLGtCQUFhLEdBQXNDLElBQUksWUFBWSxFQUFFLENBQUM7UUFDdEUsZUFBVSxHQUFzQyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQ25FLFdBQU0sR0FBc0MsSUFBSSxZQUFZLEVBQUUsQ0FBQztRQUMvRCxZQUFPLEdBQXVDLElBQUksWUFBWSxFQUFFLENBQUM7UUFDakUsY0FBUyxHQUF1QyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQ25FLGVBQVUsR0FBdUMsSUFBSSxZQUFZLEVBQUUsQ0FBQztRQUNwRSxjQUFTLEdBQTBDLElBQUksWUFBWSxFQUFFLENBQUM7UUFDdEUsZUFBVSxHQUEwQyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQ3ZFLFlBQU8sR0FBMEMsSUFBSSxZQUFZLEVBQUUsQ0FBQztR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WUFBWTtJQUNaLFdBQVc7SUFDWCxlQUFlO0lBQ2YsWUFBWTtJQUNaLFFBQVE7SUFDUixlQUFlO0lBQ2YsU0FBUztJQUNULFdBQVc7SUFDWCxZQUFZO0lBQ1osY0FBYztJQUNkLFFBQVE7SUFDUixRQUFRO0lBQ1IsV0FBVztJQUNYLFlBQVk7SUFDWixTQUFTO0lBQ1QsZUFBZTtJQUNmLGFBQWE7SUFDYixjQUFjO0lBQ2QsY0FBYztJQUNkLGFBQWE7SUFDYixZQUFZO0lBQ1osYUFBYTtJQUNiLFdBQVc7SUFDWCxjQUFjO0lBQ2QscUJBQXFCO0lBQ3JCLGlCQUFpQjtJQUNqQixrQkFBa0I7SUFDbEIsU0FBUztJQUNULGVBQWU7SUFDZixjQUFjO0lBQ2QsY0FBYztJQUNkLGlCQUFpQjtJQUNqQixRQUFRO0lBQ1IsVUFBVTtJQUNWLFNBQVM7SUFDVCxlQUFlO0lBQ2YsbUJBQW1CO0lBQ25CLGFBQWE7SUFDYixjQUFjO0lBQ2QsUUFBUTtJQUNSLFVBQVU7SUFDVixRQUFRO0lBQ1IsYUFBYTtDQUNkLENBQUMiLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgeyBPdXRwdXQsIEV2ZW50RW1pdHRlciB9IGZyb20gJ0Bhbmd1bGFyL2NvcmUnO1xuXG5leHBvcnQgaW50ZXJmYWNlIEV2ZW50T2JqPFQ+IHtcbiAgZXZlbnQ6IFQ7XG4gIGVkaXRvcjogYW55O1xufVxuXG5leHBvcnQgY2xhc3MgRXZlbnRzIHtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkJlZm9yZVBhc3RlOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8Q2xpcGJvYXJkRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkJsdXI6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxGb2N1c0V2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25DbGljazogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPE1vdXNlRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkNvbnRleHRNZW51OiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8TW91c2VFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uQ29weTogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPENsaXBib2FyZEV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25DdXQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxDbGlwYm9hcmRFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uRGJsY2xpY2s6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxNb3VzZUV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25EcmFnOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8RHJhZ0V2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25EcmFnRHJvcDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPERyYWdFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uRHJhZ0VuZDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPERyYWdFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uRHJhZ0dlc3R1cmU6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxEcmFnRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkRyYWdPdmVyOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8RHJhZ0V2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Ecm9wOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8RHJhZ0V2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Gb2N1czogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPEZvY3VzRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkZvY3VzSW46IEV2ZW50RW1pdHRlcjxFdmVudE9iajxGb2N1c0V2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Gb2N1c091dDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPEZvY3VzRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbktleURvd246IEV2ZW50RW1pdHRlcjxFdmVudE9iajxLZXlib2FyZEV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25LZXlQcmVzczogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPEtleWJvYXJkRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbktleVVwOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8S2V5Ym9hcmRFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uTW91c2VEb3duOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8TW91c2VFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uTW91c2VFbnRlcjogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPE1vdXNlRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbk1vdXNlTGVhdmU6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxNb3VzZUV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Nb3VzZU1vdmU6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxNb3VzZUV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Nb3VzZU91dDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPE1vdXNlRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbk1vdXNlT3ZlcjogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPE1vdXNlRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbk1vdXNlVXA6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxNb3VzZUV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25QYXN0ZTogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPENsaXBib2FyZEV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25TZWxlY3Rpb25DaGFuZ2U6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uQWN0aXZhdGU6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkFkZFVuZG86IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkJlZm9yZUFkZFVuZG86IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkJlZm9yZUV4ZWNDb21tYW5kOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25CZWZvcmVHZXRDb250ZW50OiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25CZWZvcmVSZW5kZXJVSTogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uQmVmb3JlU2V0Q29udGVudDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uQ2hhbmdlOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25DbGVhclVuZG9zOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25EZWFjdGl2YXRlOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25EaXJ0eTogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uRXhlY0NvbW1hbmQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkdldENvbnRlbnQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkhpZGU6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkluaXQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkluaXROZ01vZGVsOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Mb2FkQ29udGVudDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uTm9kZUNoYW5nZTogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uUG9zdFByb2Nlc3M6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvblBvc3RSZW5kZXI6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvblByZUluaXQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvblByZVByb2Nlc3M6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvblByb2dyZXNzU3RhdGU6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvblJlZG86IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvblJlbW92ZTogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uUmVzZXQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvblNhdmVDb250ZW50OiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25TZXRBdHRyaWI6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbk9iamVjdFJlc2l6ZVN0YXJ0OiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25PYmplY3RSZXNpemVkOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25PYmplY3RTZWxlY3RlZDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uU2V0Q29udGVudDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uU2hvdzogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uU3VibWl0OiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25VbmRvOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25WaXN1YWxBaWQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbn1cblxuZXhwb3J0IGNvbnN0IHZhbGlkRXZlbnRzOiAoa2V5b2YgRXZlbnRzKVtdID0gW1xuICAnb25BY3RpdmF0ZScsXG4gICdvbkFkZFVuZG8nLFxuICAnb25CZWZvcmVBZGRVbmRvJyxcbiAgJ29uQmVmb3JlRXhlY0NvbW1hbmQnLFxuICAnb25CZWZvcmVHZXRDb250ZW50JyxcbiAgJ29uQmVmb3JlUmVuZGVyVUknLFxuICAnb25CZWZvcmVTZXRDb250ZW50JyxcbiAgJ29uQmVmb3JlUGFzdGUnLFxuICAnb25CbHVyJyxcbiAgJ29uQ2hhbmdlJyxcbiAgJ29uQ2xlYXJVbmRvcycsXG4gICdvbkNsaWNrJyxcbiAgJ29uQ29udGV4dE1lbnUnLFxuICAnb25Db3B5JyxcbiAgJ29uQ3V0JyxcbiAgJ29uRGJsY2xpY2snLFxuICAnb25EZWFjdGl2YXRlJyxcbiAgJ29uRGlydHknLFxuICAnb25EcmFnJyxcbiAgJ29uRHJhZ0Ryb3AnLFxuICAnb25EcmFnRW5kJyxcbiAgJ29uRHJhZ0dlc3R1cmUnLFxuICAnb25EcmFnT3ZlcicsXG4gICdvbkRyb3AnLFxuICAnb25FeGVjQ29tbWFuZCcsXG4gICdvbkZvY3VzJyxcbiAgJ29uRm9jdXNJbicsXG4gICdvbkZvY3VzT3V0JyxcbiAgJ29uR2V0Q29udGVudCcsXG4gICdvbkhpZGUnLFxuICAnb25Jbml0JyxcbiAgJ29uS2V5RG93bicsXG4gICdvbktleVByZXNzJyxcbiAgJ29uS2V5VXAnLFxuICAnb25Mb2FkQ29udGVudCcsXG4gICdvbk1vdXNlRG93bicsXG4gICdvbk1vdXNlRW50ZXInLFxuICAnb25Nb3VzZUxlYXZlJyxcbiAgJ29uTW91c2VNb3ZlJyxcbiAgJ29uTW91c2VPdXQnLFxuICAnb25Nb3VzZU92ZXInLFxuICAnb25Nb3VzZVVwJyxcbiAgJ29uTm9kZUNoYW5nZScsXG4gICdvbk9iamVjdFJlc2l6ZVN0YXJ0JyxcbiAgJ29uT2JqZWN0UmVzaXplZCcsXG4gICdvbk9iamVjdFNlbGVjdGVkJyxcbiAgJ29uUGFzdGUnLFxuICAnb25Qb3N0UHJvY2VzcycsXG4gICdvblBvc3RSZW5kZXInLFxuICAnb25QcmVQcm9jZXNzJyxcbiAgJ29uUHJvZ3Jlc3NTdGF0ZScsXG4gICdvblJlZG8nLFxuICAnb25SZW1vdmUnLFxuICAnb25SZXNldCcsXG4gICdvblNhdmVDb250ZW50JyxcbiAgJ29uU2VsZWN0aW9uQ2hhbmdlJyxcbiAgJ29uU2V0QXR0cmliJyxcbiAgJ29uU2V0Q29udGVudCcsXG4gICdvblNob3cnLFxuICAnb25TdWJtaXQnLFxuICAnb25VbmRvJyxcbiAgJ29uVmlzdWFsQWlkJ1xuXTtcbiJdfQ==