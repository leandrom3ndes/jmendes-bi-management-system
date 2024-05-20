import { TestBed } from '@angular/core/testing';

import { ActionApiService } from './action-api.service';

describe('ActionApiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ActionApiService = TestBed.get(ActionApiService);
    expect(service).toBeTruthy();
  });
});
