import { TestBed } from '@angular/core/testing';

import { ArDashboardApiService } from './arDashboard-api.service';

describe('ArDashboardApiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ArDashboardApiService = TestBed.get(ArDashboardApiService);
    expect(service).toBeTruthy();
  });
});
