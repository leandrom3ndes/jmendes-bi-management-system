import { TestBed } from '@angular/core/testing';

import { BlocklyApiService } from './blockly-api.service';

describe('BlocklyApiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: BlocklyApiService = TestBed.get(BlocklyApiService);
    expect(service).toBeTruthy();
  });
});
