import { TestBed } from '@angular/core/testing';

import { FormApiService } from './form-api.service';

describe('FormApiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: FormApiService = TestBed.get(FormApiService);
    expect(service).toBeTruthy();
  });
});
