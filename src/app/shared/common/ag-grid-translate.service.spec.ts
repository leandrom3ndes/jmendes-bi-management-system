import { TestBed } from '@angular/core/testing';

import { AgGridTranslateService } from './ag-grid-translate.service';

describe('AgGridTranslateService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: AgGridTranslateService = TestBed.get(AgGridTranslateService);
    expect(service).toBeTruthy();
  });
});
