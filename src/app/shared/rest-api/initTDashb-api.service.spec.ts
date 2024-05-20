import { TestBed } from '@angular/core/testing';

import { InitTDashbApiService } from './initTDashb-api.service';

describe('InitTDashbApiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: InitTDashbApiService = TestBed.get(InitTDashbApiService);
    expect(service).toBeTruthy();
  });
});
