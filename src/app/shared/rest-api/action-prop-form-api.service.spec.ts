import { TestBed } from '@angular/core/testing';

import { ActionPropFormApiService } from './action-prop-form-api.service';

describe('ActionPropFormApiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ActionPropFormApiService = TestBed.get(ActionPropFormApiService);
    expect(service).toBeTruthy();
  });
});
