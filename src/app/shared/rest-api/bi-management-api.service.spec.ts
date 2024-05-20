import { TestBed } from '@angular/core/testing';

import { biManagementApiService } from './bi-management-api.service';

describe('biManagementApiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: biManagementApiService = TestBed.get(biManagementApiService);
    expect(service).toBeTruthy();
  });
});
