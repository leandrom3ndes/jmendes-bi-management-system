import { Output, EventEmitter } from '@angular/core';
export class Events {
    constructor() {
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
export const validEvents = [
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
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiRXZlbnRzLmpzIiwic291cmNlUm9vdCI6Im5nOi8vQHRpbnltY2UvdGlueW1jZS1hbmd1bGFyLyIsInNvdXJjZXMiOlsiZWRpdG9yL0V2ZW50cy50cyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSxPQUFPLEVBQUUsTUFBTSxFQUFFLFlBQVksRUFBRSxNQUFNLGVBQWUsQ0FBQztBQU9yRCxNQUFNLE9BQU8sTUFBTTtJQUFuQjtRQUNtQixrQkFBYSxHQUEyQyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQzNFLFdBQU0sR0FBdUMsSUFBSSxZQUFZLEVBQUUsQ0FBQztRQUNoRSxZQUFPLEdBQXVDLElBQUksWUFBWSxFQUFFLENBQUM7UUFDakUsa0JBQWEsR0FBdUMsSUFBSSxZQUFZLEVBQUUsQ0FBQztRQUN2RSxXQUFNLEdBQTJDLElBQUksWUFBWSxFQUFFLENBQUM7UUFDcEUsVUFBSyxHQUEyQyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQ25FLGVBQVUsR0FBdUMsSUFBSSxZQUFZLEVBQUUsQ0FBQztRQUNwRSxXQUFNLEdBQXNDLElBQUksWUFBWSxFQUFFLENBQUM7UUFDL0QsZUFBVSxHQUFzQyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQ25FLGNBQVMsR0FBc0MsSUFBSSxZQUFZLEVBQUUsQ0FBQztRQUNsRSxrQkFBYSxHQUFzQyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQ3RFLGVBQVUsR0FBc0MsSUFBSSxZQUFZLEVBQUUsQ0FBQztRQUNuRSxXQUFNLEdBQXNDLElBQUksWUFBWSxFQUFFLENBQUM7UUFDL0QsWUFBTyxHQUF1QyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQ2pFLGNBQVMsR0FBdUMsSUFBSSxZQUFZLEVBQUUsQ0FBQztRQUNuRSxlQUFVLEdBQXVDLElBQUksWUFBWSxFQUFFLENBQUM7UUFDcEUsY0FBUyxHQUEwQyxJQUFJLFlBQVksRUFBRSxDQUFDO1FBQ3RFLGVBQVUsR0FBMEMsSUFBSSxZQUFZLEVBQUUsQ0FBQztRQUN2RSxZQUFPLEdBQTBDLElBQUks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ZTtJQUNmLFlBQVk7SUFDWixRQUFRO0lBQ1IsZUFBZTtJQUNmLFNBQVM7SUFDVCxXQUFXO0lBQ1gsWUFBWTtJQUNaLGNBQWM7SUFDZCxRQUFRO0lBQ1IsUUFBUTtJQUNSLFdBQVc7SUFDWCxZQUFZO0lBQ1osU0FBUztJQUNULGVBQWU7SUFDZixhQUFhO0lBQ2IsY0FBYztJQUNkLGNBQWM7SUFDZCxhQUFhO0lBQ2IsWUFBWTtJQUNaLGFBQWE7SUFDYixXQUFXO0lBQ1gsY0FBYztJQUNkLHFCQUFxQjtJQUNyQixpQkFBaUI7SUFDakIsa0JBQWtCO0lBQ2xCLFNBQVM7SUFDVCxlQUFlO0lBQ2YsY0FBYztJQUNkLGNBQWM7SUFDZCxpQkFBaUI7SUFDakIsUUFBUTtJQUNSLFVBQVU7SUFDVixTQUFTO0lBQ1QsZUFBZTtJQUNmLG1CQUFtQjtJQUNuQixhQUFhO0lBQ2IsY0FBYztJQUNkLFFBQVE7SUFDUixVQUFVO0lBQ1YsUUFBUTtJQUNSLGFBQWE7Q0FDZCxDQUFDIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IHsgT3V0cHV0LCBFdmVudEVtaXR0ZXIgfSBmcm9tICdAYW5ndWxhci9jb3JlJztcblxuZXhwb3J0IGludGVyZmFjZSBFdmVudE9iajxUPiB7XG4gIGV2ZW50OiBUO1xuICBlZGl0b3I6IGFueTtcbn1cblxuZXhwb3J0IGNsYXNzIEV2ZW50cyB7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25CZWZvcmVQYXN0ZTogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPENsaXBib2FyZEV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25CbHVyOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8Rm9jdXNFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uQ2xpY2s6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxNb3VzZUV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Db250ZXh0TWVudTogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPE1vdXNlRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkNvcHk6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxDbGlwYm9hcmRFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uQ3V0OiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8Q2xpcGJvYXJkRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkRibGNsaWNrOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8TW91c2VFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uRHJhZzogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPERyYWdFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uRHJhZ0Ryb3A6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxEcmFnRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkRyYWdFbmQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxEcmFnRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkRyYWdHZXN0dXJlOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8RHJhZ0V2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25EcmFnT3ZlcjogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPERyYWdFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uRHJvcDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPERyYWdFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uRm9jdXM6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxGb2N1c0V2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Gb2N1c0luOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8Rm9jdXNFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uRm9jdXNPdXQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxGb2N1c0V2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25LZXlEb3duOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8S2V5Ym9hcmRFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uS2V5UHJlc3M6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxLZXlib2FyZEV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25LZXlVcDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPEtleWJvYXJkRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbk1vdXNlRG93bjogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPE1vdXNlRXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbk1vdXNlRW50ZXI6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxNb3VzZUV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Nb3VzZUxlYXZlOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8TW91c2VFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uTW91c2VNb3ZlOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8TW91c2VFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uTW91c2VPdXQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxNb3VzZUV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Nb3VzZU92ZXI6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxNb3VzZUV2ZW50Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Nb3VzZVVwOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8TW91c2VFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uUGFzdGU6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxDbGlwYm9hcmRFdmVudD4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uU2VsZWN0aW9uQ2hhbmdlOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8RXZlbnQ+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkFjdGl2YXRlOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25BZGRVbmRvOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25CZWZvcmVBZGRVbmRvOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25CZWZvcmVFeGVjQ29tbWFuZDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uQmVmb3JlR2V0Q29udGVudDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uQmVmb3JlUmVuZGVyVUk6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkJlZm9yZVNldENvbnRlbnQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkNoYW5nZTogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uQ2xlYXJVbmRvczogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uRGVhY3RpdmF0ZTogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uRGlydHk6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbkV4ZWNDb21tYW5kOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25HZXRDb250ZW50OiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25IaWRlOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Jbml0OiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Jbml0TmdNb2RlbDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uTG9hZENvbnRlbnQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvbk5vZGVDaGFuZ2U6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvblBvc3RQcm9jZXNzOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Qb3N0UmVuZGVyOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25QcmVJbml0OiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25QcmVQcm9jZXNzOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25Qcm9ncmVzc1N0YXRlOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25SZWRvOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25SZW1vdmU6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvblJlc2V0OiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25TYXZlQ29udGVudDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uU2V0QXR0cmliOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBwdWJsaWMgb25PYmplY3RSZXNpemVTdGFydDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uT2JqZWN0UmVzaXplZDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uT2JqZWN0U2VsZWN0ZWQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvblNldENvbnRlbnQ6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvblNob3c6IEV2ZW50RW1pdHRlcjxFdmVudE9iajxhbnk+PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIHB1YmxpYyBvblN1Ym1pdDogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uVW5kbzogRXZlbnRFbWl0dGVyPEV2ZW50T2JqPGFueT4+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgcHVibGljIG9uVmlzdWFsQWlkOiBFdmVudEVtaXR0ZXI8RXZlbnRPYmo8YW55Pj4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG59XG5cbmV4cG9ydCBjb25zdCB2YWxpZEV2ZW50czogKGtleW9mIEV2ZW50cylbXSA9IFtcbiAgJ29uQWN0aXZhdGUnLFxuICAnb25BZGRVbmRvJyxcbiAgJ29uQmVmb3JlQWRkVW5kbycsXG4gICdvbkJlZm9yZUV4ZWNDb21tYW5kJyxcbiAgJ29uQmVmb3JlR2V0Q29udGVudCcsXG4gICdvbkJlZm9yZVJlbmRlclVJJyxcbiAgJ29uQmVmb3JlU2V0Q29udGVudCcsXG4gICdvbkJlZm9yZVBhc3RlJyxcbiAgJ29uQmx1cicsXG4gICdvbkNoYW5nZScsXG4gICdvbkNsZWFyVW5kb3MnLFxuICAnb25DbGljaycsXG4gICdvbkNvbnRleHRNZW51JyxcbiAgJ29uQ29weScsXG4gICdvbkN1dCcsXG4gICdvbkRibGNsaWNrJyxcbiAgJ29uRGVhY3RpdmF0ZScsXG4gICdvbkRpcnR5JyxcbiAgJ29uRHJhZycsXG4gICdvbkRyYWdEcm9wJyxcbiAgJ29uRHJhZ0VuZCcsXG4gICdvbkRyYWdHZXN0dXJlJyxcbiAgJ29uRHJhZ092ZXInLFxuICAnb25Ecm9wJyxcbiAgJ29uRXhlY0NvbW1hbmQnLFxuICAnb25Gb2N1cycsXG4gICdvbkZvY3VzSW4nLFxuICAnb25Gb2N1c091dCcsXG4gICdvbkdldENvbnRlbnQnLFxuICAnb25IaWRlJyxcbiAgJ29uSW5pdCcsXG4gICdvbktleURvd24nLFxuICAnb25LZXlQcmVzcycsXG4gICdvbktleVVwJyxcbiAgJ29uTG9hZENvbnRlbnQnLFxuICAnb25Nb3VzZURvd24nLFxuICAnb25Nb3VzZUVudGVyJyxcbiAgJ29uTW91c2VMZWF2ZScsXG4gICdvbk1vdXNlTW92ZScsXG4gICdvbk1vdXNlT3V0JyxcbiAgJ29uTW91c2VPdmVyJyxcbiAgJ29uTW91c2VVcCcsXG4gICdvbk5vZGVDaGFuZ2UnLFxuICAnb25PYmplY3RSZXNpemVTdGFydCcsXG4gICdvbk9iamVjdFJlc2l6ZWQnLFxuICAnb25PYmplY3RTZWxlY3RlZCcsXG4gICdvblBhc3RlJyxcbiAgJ29uUG9zdFByb2Nlc3MnLFxuICAnb25Qb3N0UmVuZGVyJyxcbiAgJ29uUHJlUHJvY2VzcycsXG4gICdvblByb2dyZXNzU3RhdGUnLFxuICAnb25SZWRvJyxcbiAgJ29uUmVtb3ZlJyxcbiAgJ29uUmVzZXQnLFxuICAnb25TYXZlQ29udGVudCcsXG4gICdvblNlbGVjdGlvbkNoYW5nZScsXG4gICdvblNldEF0dHJpYicsXG4gICdvblNldENvbnRlbnQnLFxuICAnb25TaG93JyxcbiAgJ29uU3VibWl0JyxcbiAgJ29uVW5kbycsXG4gICdvblZpc3VhbEFpZCdcbl07XG4iXX0=