import { AfterViewInit, ElementRef, NgZone, OnDestroy, InjectionToken } from '@angular/core';
import { ControlValueAccessor } from '@angular/forms';
import { Events } from './Events';
export declare const TINYMCE_SCRIPT_SRC: InjectionToken<string>;
export declare class EditorComponent extends Events implements AfterViewInit, ControlValueAccessor, OnDestroy {
    private platformId;
    private tinymceScriptSrc?;
    // @ts-ignore
    set disabled(val: boolean);
    // @ts-ignore
    get disabled(): boolean;
    // @ts-ignore
    get editor(): any;
    ngZone: NgZone;
    cloudChannel: string;
    apiKey: string;
    init: Record<string, any> | undefined;
    id: string;
    initialValue: string | undefined;
    outputFormat: 'html' | 'text' | undefined;
    inline: boolean | undefined;
    tagName: string | undefined;
    plugins: string | undefined;
    toolbar: string | string[] | undefined;
    modelEvents: string;
    allowedEvents: string | string[] | undefined;
    ignoreEvents: string | string[] | undefined;
    private _elementRef;
    private _element;
    private _disabled;
    private _editor;
    private onTouchedCallback;
    private onChangeCallback;
    constructor(elementRef: ElementRef, ngZone: NgZone, platformId: Object, tinymceScriptSrc?: string);
    writeValue(value: string | null): void;
    registerOnChange(fn: (_: any) => void): void;
    registerOnTouched(fn: any): void;
    setDisabledState(isDisabled: boolean): void;
    ngAfterViewInit(): void;
    ngOnDestroy(): void;
    createElement(): void;
    initialise(): void;
    private getScriptSrc;
    private initEditor;
}
