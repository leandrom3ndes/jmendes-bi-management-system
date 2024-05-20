import { TestBed } from '@angular/core/testing';

import { ValidationCondApiService } from './validation-cond-api.service';

describe('ValidationCondApiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ValidationCondApiService = TestBed.get(ValidationCondApiService);
    expect(service).toBeTruthy();
  });
});
