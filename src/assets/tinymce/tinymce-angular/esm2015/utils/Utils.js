/**
 * Copyright (c) 2017-present, Ephox, Inc.
 *
 * This source code is licensed under the Apache 2 license found in the
 * LICENSE file in the root directory of this source tree.
 *
 */
import { validEvents } from '../editor/Events';
const bindHandlers = (ctx, editor) => {
    const allowedEvents = getValidEvents(ctx);
    allowedEvents.forEach((eventName) => {
        const eventEmitter = ctx[eventName];
        editor.on(eventName.substring(2), (event) => ctx.ngZone.run(() => eventEmitter.emit({ event, editor })));
    });
};
const ɵ0 = bindHandlers;
const getValidEvents = (ctx) => {
    const ignoredEvents = parseStringProperty(ctx.ignoreEvents, []);
    const allowedEvents = parseStringProperty(ctx.allowedEvents, validEvents).filter((event) => validEvents.includes(event) && !ignoredEvents.includes(event));
    return allowedEvents;
};
const ɵ1 = getValidEvents;
const parseStringProperty = (property, defaultValue) => {
    if (typeof property === 'string') {
        return property.split(',').map((value) => value.trim());
    }
    if (Array.isArray(property)) {
        return property;
    }
    return defaultValue;
};
const ɵ2 = parseStringProperty;
let unique = 0;
const uuid = (prefix) => {
    const date = new Date();
    const time = date.getTime();
    const random = Math.floor(Math.random() * 1000000000);
    unique++;
    return prefix + '_' + random + unique + String(time);
};
const ɵ3 = uuid;
const isTextarea = (element) => {
    return typeof element !== 'undefined' && element.tagName.toLowerCase() === 'textarea';
};
const ɵ4 = isTextarea;
const normalizePluginArray = (plugins) => {
    if (typeof plugins === 'undefined' || plugins === '') {
        return [];
    }
    return Array.isArray(plugins) ? plugins : plugins.split(' ');
};
const ɵ5 = normalizePluginArray;
const mergePlugins = (initPlugins, inputPlugins) => normalizePluginArray(initPlugins).concat(normalizePluginArray(inputPlugins));
const ɵ6 = mergePlugins;
// tslint:disable-next-line:no-empty
const noop = () => { };
const ɵ7 = noop;
const isNullOrUndefined = (value) => value === null || value === undefined;
const ɵ8 = isNullOrUndefined;
export { bindHandlers, uuid, isTextarea, normalizePluginArray, mergePlugins, noop, isNullOrUndefined };
export { ɵ0, ɵ1, ɵ2, ɵ3, ɵ4, ɵ5, ɵ6, ɵ7, ɵ8 };
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiVXRpbHMuanMiLCJzb3VyY2VSb290Ijoibmc6Ly9AdGlueW1jZS90aW55bWNlLWFuZ3VsYXIvIiwic291cmNlcyI6WyJ1dGlscy9VdGlscy50cyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7O0dBTUc7QUFJSCxPQUFPLEVBQUUsV0FBVyxFQUFVLE1BQU0sa0JBQWtCLENBQUM7QUFFdkQsTUFBTSxZQUFZLEdBQUcsQ0FBQyxHQUFvQixFQUFFLE1BQVcsRUFBUSxFQUFFO0lBQy9ELE1BQU0sYUFBYSxHQUFHLGNBQWMsQ0FBQyxHQUFHLENBQUMsQ0FBQztJQUMxQyxhQUFhLENBQUMsT0FBTyxDQUFDLENBQUMsU0FBUyxFQUFFLEVBQUU7UUFDbEMsTUFBTSxZQUFZLEdBQXNCLEdBQUcsQ0FBQyxTQUFTLENBQUMsQ0FBQztRQUN2RCxNQUFNLENBQUMsRUFBRSxDQUFDLFNBQVMsQ0FBQyxTQUFTLENBQUMsQ0FBQyxDQUFDLEVBQUUsQ0FBQyxLQUFVLEVBQUUsRUFBRSxDQUFDLEdBQUcsQ0FBQyxNQUFNLENBQUMsR0FBRyxDQUFDLEdBQUcsRUFBRSxDQUFDLFlBQVksQ0FBQyxJQUFJLENBQUMsRUFBRSxLQUFLLEVBQUUsTUFBTSxFQUFFLENBQUMsQ0FBQyxDQUFDLENBQUM7SUFDaEgsQ0FBQyxDQUFDLENBQUM7QUFDTCxDQUFDLENBQUM7O0FBRUYsTUFBTSxjQUFjLEdBQUcsQ0FBQyxHQUFvQixFQUFvQixFQUFFO0lBQ2hFLE1BQU0sYUFBYSxHQUFHLG1CQUFtQixDQUFDLEdBQUcsQ0FBQyxZQUFZLEVBQUUsRUFBRSxDQUFDLENBQUM7SUFDaEUsTUFBTSxhQUFhLEdBQUcsbUJBQW1CLENBQUMsR0FBRyxDQUFDLGFBQWEsRUFBRSxXQUFXLENBQUMsQ0FBQyxNQUFNLENBQzlFLENBQUMsS0FBSyxFQUFFLEVBQUUsQ0FBQyxXQUFXLENBQUMsUUFBUSxDQUFDLEtBQXVCLENBQUMsSUFBSSxDQUFDLGFBQWEsQ0FBQyxRQUFRLENBQUMsS0FBSyxDQUFDLENBQXFCLENBQUM7SUFDbEgsT0FBTyxhQUFhLENBQUM7QUFDdkIsQ0FBQyxDQUFBOztBQUVELE1BQU0sbUJBQW1CLEdBQUcsQ0FBQyxRQUF1QyxFQUFFLFlBQThCLEVBQVksRUFBRTtJQUNoSCxJQUFLLE9BQU8sUUFBUSxLQUFLLFFBQVEsRUFBRTtRQUNqQyxPQUFPLFFBQVEsQ0FBQyxLQUFLLENBQUMsR0FBRyxDQUFDLENBQUMsR0FBRyxDQUFDLENBQUMsS0FBSyxFQUFFLEVBQUUsQ0FBQyxLQUFLLENBQUMsSUFBSSxFQUFFLENBQUMsQ0FBQztLQUN6RDtJQUNELElBQUssS0FBSyxDQUFDLE9BQU8sQ0FBQyxRQUFRLENBQUMsRUFBRTtRQUM1QixPQUFPLFFBQVEsQ0FBQztLQUNqQjtJQUNELE9BQU8sWUFBWSxDQUFDO0FBQ3RCLENBQUMsQ0FBQzs7QUFFRixJQUFJLE1BQU0sR0FBRyxDQUFDLENBQUM7QUFFZixNQUFNLElBQUksR0FBRyxDQUFDLE1BQWMsRUFBVSxFQUFFO0lBQ3RDLE1BQU0sSUFBSSxHQUFHLElBQUksSUFBSSxFQUFFLENBQUM7SUFDeEIsTUFBTSxJQUFJLEdBQUcsSUFBSSxDQUFDLE9BQU8sRUFBRSxDQUFDO0lBQzVCLE1BQU0sTUFBTSxHQUFHLElBQUksQ0FBQyxLQUFLLENBQUMsSUFBSSxDQUFDLE1BQU0sRUFBRSxHQUFHLFVBQVUsQ0FBQyxDQUFDO0lBRXRELE1BQU0sRUFBRSxDQUFDO0lBRVQsT0FBTyxNQUFNLEdBQUcsR0FBRyxHQUFHLE1BQU0sR0FBRyxNQUFNLEdBQUcsTUFBTSxDQUFDLElBQUksQ0FBQyxDQUFDO0FBQ3ZELENBQUMsQ0FBQzs7QUFFRixNQUFNLFVBQVUsR0FBRyxDQUFDLE9BQWlCLEVBQWtDLEVBQUU7SUFDdkUsT0FBTyxPQUFPLE9BQU8sS0FBSyxXQUFXLElBQUksT0FBTyxDQUFDLE9BQU8sQ0FBQyxXQUFXLEVBQUUsS0FBSyxVQUFVLENBQUM7QUFDeEYsQ0FBQyxDQUFDOztBQUVGLE1BQU0sb0JBQW9CLEdBQUcsQ0FBQyxPQUEyQixFQUFZLEVBQUU7SUFDckUsSUFBSSxPQUFPLE9BQU8sS0FBSyxXQUFXLElBQUksT0FBTyxLQUFLLEVBQUUsRUFBRTtRQUNwRCxPQUFPLEVBQUUsQ0FBQztLQUNYO0lBRUQsT0FBTyxLQUFLLENBQUMsT0FBTyxDQUFDLE9BQU8sQ0FBQyxDQUFDLENBQUMsQ0FBQyxPQUFPLENBQUMsQ0FBQyxDQUFDLE9BQU8sQ0FBQyxLQUFLLENBQUMsR0FBRyxDQUFDLENBQUM7QUFDL0QsQ0FBQyxDQUFDOztBQUVGLE1BQU0sWUFBWSxHQUFHLENBQUMsV0FBOEIsRUFBRSxZQUFnQyxFQUFFLEVBQUUsQ0FDeEYsb0JBQW9CLENBQUMsV0FBVyxDQUFDLENBQUMsTUFBTSxDQUFDLG9CQUFvQixDQUFDLFlBQVksQ0FBQyxDQUFDLENBQUM7O0FBRS9FLG9DQUFvQztBQUNwQyxNQUFNLElBQUksR0FBNkIsR0FBRyxFQUFFLEdBQUcsQ0FBQyxDQUFDOztBQUVqRCxNQUFNLGlCQUFpQixHQUFHLENBQUMsS0FBVSxFQUE2QixFQUFFLENBQUMsS0FBSyxLQUFLLElBQUksSUFBSSxLQUFLLEtBQUssU0FBUyxDQUFDOztBQUUzRyxPQUFPLEVBQ0wsWUFBWSxFQUNaLElBQUksRUFDSixVQUFVLEVBQ1Ysb0JBQW9CLEVBQ3BCLFlBQVksRUFDWixJQUFJLEVBQ0osaUJBQWlCLEVBQ2xCLENBQUMiLCJzb3VyY2VzQ29udGVudCI6WyIvKipcbiAqIENvcHlyaWdodCAoYykgMjAxNy1wcmVzZW50LCBFcGhveCwgSW5jLlxuICpcbiAqIFRoaXMgc291cmNlIGNvZGUgaXMgbGljZW5zZWQgdW5kZXIgdGhlIEFwYWNoZSAyIGxpY2Vuc2UgZm91bmQgaW4gdGhlXG4gKiBMSUNFTlNFIGZpbGUgaW4gdGhlIHJvb3QgZGlyZWN0b3J5IG9mIHRoaXMgc291cmNlIHRyZWUuXG4gKlxuICovXG5cbmltcG9ydCB7IEV2ZW50RW1pdHRlciB9IGZyb20gJ0Bhbmd1bGFyL2NvcmUnO1xuaW1wb3J0IHsgRWRpdG9yQ29tcG9uZW50IH0gZnJvbSAnLi4vZWRpdG9yL2VkaXRvci5jb21wb25lbnQnO1xuaW1wb3J0IHsgdmFsaWRFdmVudHMsIEV2ZW50cyB9IGZyb20gJy4uL2VkaXRvci9FdmVudHMnO1xuXG5jb25zdCBiaW5kSGFuZGxlcnMgPSAoY3R4OiBFZGl0b3JDb21wb25lbnQsIGVkaXRvcjogYW55KTogdm9pZCA9PiB7XG4gIGNvbnN0IGFsbG93ZWRFdmVudHMgPSBnZXRWYWxpZEV2ZW50cyhjdHgpO1xuICBhbGxvd2VkRXZlbnRzLmZvckVhY2goKGV2ZW50TmFtZSkgPT4ge1xuICAgIGNvbnN0IGV2ZW50RW1pdHRlcjogRXZlbnRFbWl0dGVyPGFueT4gPSBjdHhbZXZlbnROYW1lXTtcbiAgICBlZGl0b3Iub24oZXZlbnROYW1lLnN1YnN0cmluZygyKSwgKGV2ZW50OiBhbnkpID0+IGN0eC5uZ1pvbmUucnVuKCgpID0+IGV2ZW50RW1pdHRlci5lbWl0KHsgZXZlbnQsIGVkaXRvciB9KSkpO1xuICB9KTtcbn07XG5cbmNvbnN0IGdldFZhbGlkRXZlbnRzID0gKGN0eDogRWRpdG9yQ29tcG9uZW50KTogKGtleW9mIEV2ZW50cylbXSA9PiB7XG4gIGNvbnN0IGlnbm9yZWRFdmVudHMgPSBwYXJzZVN0cmluZ1Byb3BlcnR5KGN0eC5pZ25vcmVFdmVudHMsIFtdKTtcbiAgY29uc3QgYWxsb3dlZEV2ZW50cyA9IHBhcnNlU3RyaW5nUHJvcGVydHkoY3R4LmFsbG93ZWRFdmVudHMsIHZhbGlkRXZlbnRzKS5maWx0ZXIoXG4gICAgKGV2ZW50KSA9PiB2YWxpZEV2ZW50cy5pbmNsdWRlcyhldmVudCBhcyAoa2V5b2YgRXZlbnRzKSkgJiYgIWlnbm9yZWRFdmVudHMuaW5jbHVkZXMoZXZlbnQpKSBhcyAoa2V5b2YgRXZlbnRzKVtdO1xuICByZXR1cm4gYWxsb3dlZEV2ZW50cztcbn1cblxuY29uc3QgcGFyc2VTdHJpbmdQcm9wZXJ0eSA9IChwcm9wZXJ0eTogc3RyaW5nIHwgc3RyaW5nW10gfCB1bmRlZmluZWQsIGRlZmF1bHRWYWx1ZTogKGtleW9mIEV2ZW50cylbXSk6IHN0cmluZ1tdID0+IHtcbiAgaWYgKCB0eXBlb2YgcHJvcGVydHkgPT09ICdzdHJpbmcnKSB7XG4gICAgcmV0dXJuIHByb3BlcnR5LnNwbGl0KCcsJykubWFwKCh2YWx1ZSkgPT4gdmFsdWUudHJpbSgpKTtcbiAgfVxuICBpZiAoIEFycmF5LmlzQXJyYXkocHJvcGVydHkpKSB7XG4gICAgcmV0dXJuIHByb3BlcnR5O1xuICB9XG4gIHJldHVybiBkZWZhdWx0VmFsdWU7XG59O1xuXG5sZXQgdW5pcXVlID0gMDtcblxuY29uc3QgdXVpZCA9IChwcmVmaXg6IHN0cmluZyk6IHN0cmluZyA9PiB7XG4gIGNvbnN0IGRhdGUgPSBuZXcgRGF0ZSgpO1xuICBjb25zdCB0aW1lID0gZGF0ZS5nZXRUaW1lKCk7XG4gIGNvbnN0IHJhbmRvbSA9IE1hdGguZmxvb3IoTWF0aC5yYW5kb20oKSAqIDEwMDAwMDAwMDApO1xuXG4gIHVuaXF1ZSsrO1xuXG4gIHJldHVybiBwcmVmaXggKyAnXycgKyByYW5kb20gKyB1bmlxdWUgKyBTdHJpbmcodGltZSk7XG59O1xuXG5jb25zdCBpc1RleHRhcmVhID0gKGVsZW1lbnQ/OiBFbGVtZW50KTogZWxlbWVudCBpcyBIVE1MVGV4dEFyZWFFbGVtZW50ID0+IHtcbiAgcmV0dXJuIHR5cGVvZiBlbGVtZW50ICE9PSAndW5kZWZpbmVkJyAmJiBlbGVtZW50LnRhZ05hbWUudG9Mb3dlckNhc2UoKSA9PT0gJ3RleHRhcmVhJztcbn07XG5cbmNvbnN0IG5vcm1hbGl6ZVBsdWdpbkFycmF5ID0gKHBsdWdpbnM/OiBzdHJpbmcgfCBzdHJpbmdbXSk6IHN0cmluZ1tdID0+IHtcbiAgaWYgKHR5cGVvZiBwbHVnaW5zID09PSAndW5kZWZpbmVkJyB8fCBwbHVnaW5zID09PSAnJykge1xuICAgIHJldHVybiBbXTtcbiAgfVxuXG4gIHJldHVybiBBcnJheS5pc0FycmF5KHBsdWdpbnMpID8gcGx1Z2lucyA6IHBsdWdpbnMuc3BsaXQoJyAnKTtcbn07XG5cbmNvbnN0IG1lcmdlUGx1Z2lucyA9IChpbml0UGx1Z2luczogc3RyaW5nIHwgc3RyaW5nW10sIGlucHV0UGx1Z2lucz86IHN0cmluZyB8IHN0cmluZ1tdKSA9PlxuICBub3JtYWxpemVQbHVnaW5BcnJheShpbml0UGx1Z2lucykuY29uY2F0KG5vcm1hbGl6ZVBsdWdpbkFycmF5KGlucHV0UGx1Z2lucykpO1xuXG4vLyB0c2xpbnQ6ZGlzYWJsZS1uZXh0LWxpbmU6bm8tZW1wdHlcbmNvbnN0IG5vb3A6ICguLi5hcmdzOiBhbnlbXSkgPT4gdm9pZCA9ICgpID0+IHsgfTtcblxuY29uc3QgaXNOdWxsT3JVbmRlZmluZWQgPSAodmFsdWU6IGFueSk6IHZhbHVlIGlzIG51bGwgfCB1bmRlZmluZWQgPT4gdmFsdWUgPT09IG51bGwgfHwgdmFsdWUgPT09IHVuZGVmaW5lZDtcblxuZXhwb3J0IHtcbiAgYmluZEhhbmRsZXJzLFxuICB1dWlkLFxuICBpc1RleHRhcmVhLFxuICBub3JtYWxpemVQbHVnaW5BcnJheSxcbiAgbWVyZ2VQbHVnaW5zLFxuICBub29wLFxuICBpc051bGxPclVuZGVmaW5lZFxufTtcbiJdfQ==