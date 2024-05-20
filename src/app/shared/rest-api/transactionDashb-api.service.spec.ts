import { TestBed } from '@angular/core/testing';

import { TransactionsDashbApiService } from './transactionDashb-api.service';

describe('LanguageApiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: TransactionsDashbApiService = TestBed.get(TransactionsDashbApiService);
    expect(service).toBeTruthy();
  });
});
