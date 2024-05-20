import { TestBed } from '@angular/core/testing';

import { ActionPropApiService } from './action-prop-api.service';

describe('ActionPropApiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ActionPropApiService = TestBed.get(ActionPropApiService);
    expect(service).toBeTruthy();
  });
});
