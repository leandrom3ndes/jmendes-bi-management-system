import { EventEmitter } from '@angular/core';
export interface EventObj<T> {
    event: T;
    editor: any;
}
export declare class Events {
    onBeforePaste: EventEmitter<EventObj<ClipboardEvent>>;
    onBlur: EventEmitter<EventObj<FocusEvent>>;
    onClick: EventEmitter<EventObj<MouseEvent>>;
    onContextMenu: EventEmitter<EventObj<MouseEvent>>;
    onCopy: EventEmitter<EventObj<ClipboardEvent>>;
    onCut: EventEmitter<EventObj<ClipboardEvent>>;
    onDblclick: EventEmitter<EventObj<MouseEvent>>;
    onDrag: EventEmitter<EventObj<DragEvent>>;
    onDragDrop: EventEmitter<EventObj<DragEvent>>;
    onDragEnd: EventEmitter<EventObj<DragEvent>>;
    onDragGesture: EventEmitter<EventObj<DragEvent>>;
    onDragOver: EventEmitter<EventObj<DragEvent>>;
    onDrop: EventEmitter<EventObj<DragEvent>>;
    onFocus: EventEmitter<EventObj<FocusEvent>>;
    onFocusIn: EventEmitter<EventObj<FocusEvent>>;
    onFocusOut: EventEmitter<EventObj<FocusEvent>>;
    onKeyDown: EventEmitter<EventObj<KeyboardEvent>>;
    onKeyPress: EventEmitter<EventObj<KeyboardEvent>>;
    onKeyUp: EventEmitter<EventObj<KeyboardEvent>>;
    onMouseDown: EventEmitter<EventObj<MouseEvent>>;
    onMouseEnter: EventEmitter<EventObj<MouseEvent>>;
    onMouseLeave: EventEmitter<EventObj<MouseEvent>>;
    onMouseMove: EventEmitter<EventObj<MouseEvent>>;
    onMouseOut: EventEmitter<EventObj<MouseEvent>>;
    onMouseOver: EventEmitter<EventObj<MouseEvent>>;
    onMouseUp: EventEmitter<EventObj<MouseEvent>>;
    onPaste: EventEmitter<EventObj<ClipboardEvent>>;
    onSelectionChange: EventEmitter<EventObj<Event>>;
    onActivate: EventEmitter<EventObj<any>>;
    onAddUndo: EventEmitter<EventObj<any>>;
    onBeforeAddUndo: EventEmitter<EventObj<any>>;
    onBeforeExecCommand: EventEmitter<EventObj<any>>;
    onBeforeGetContent: EventEmitter<EventObj<any>>;
    onBeforeRenderUI: EventEmitter<EventObj<any>>;
    onBeforeSetContent: EventEmitter<EventObj<any>>;
    onChange: EventEmitter<EventObj<any>>;
    onClearUndos: EventEmitter<EventObj<any>>;
    onDeactivate: EventEmitter<EventObj<any>>;
    onDirty: EventEmitter<EventObj<any>>;
    onExecCommand: EventEmitter<EventObj<any>>;
    onGetContent: EventEmitter<EventObj<any>>;
    onHide: EventEmitter<EventObj<any>>;
    onInit: EventEmitter<EventObj<any>>;
    onInitNgModel: EventEmitter<EventObj<any>>;
    onLoadContent: EventEmitter<EventObj<any>>;
    onNodeChange: EventEmitter<EventObj<any>>;
    onPostProcess: EventEmitter<EventObj<any>>;
    onPostRender: EventEmitter<EventObj<any>>;
    onPreInit: EventEmitter<EventObj<any>>;
    onPreProcess: EventEmitter<EventObj<any>>;
    onProgressState: EventEmitter<EventObj<any>>;
    onRedo: EventEmitter<EventObj<any>>;
    onRemove: EventEmitter<EventObj<any>>;
    onReset: EventEmitter<EventObj<any>>;
    onSaveContent: EventEmitter<EventObj<any>>;
    onSetAttrib: EventEmitter<EventObj<any>>;
    onObjectResizeStart: EventEmitter<EventObj<any>>;
    onObjectResized: EventEmitter<EventObj<any>>;
    onObjectSelected: EventEmitter<EventObj<any>>;
    onSetContent: EventEmitter<EventObj<any>>;
    onShow: EventEmitter<EventObj<any>>;
    onSubmit: EventEmitter<EventObj<any>>;
    onUndo: EventEmitter<EventObj<any>>;
    onVisualAid: EventEmitter<EventObj<any>>;
}
export declare const validEvents: (keyof Events)[];
