import { TestBed } from '@angular/core/testing';

import { PropertyApiService } from './property-api.service';

describe('PropertyApiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: PropertyApiService = TestBed.get(PropertyApiService);
    expect(service).toBeTruthy();
  });
});
