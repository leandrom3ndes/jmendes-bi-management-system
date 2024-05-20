import { TestBed } from '@angular/core/testing';

import { NewTContentService } from './newTContent-api.service';

describe('NewTContentService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: NewTContentService = TestBed.get(NewTContentService);
    expect(service).toBeTruthy();
  });
});
