import {TestBed} from '@angular/core/testing';

import {ProcessTypeApiService} from './processtype-api.service';

describe('ProcessTypeApiService', () => {
    beforeEach(() => TestBed.configureTestingModule({}));

    it('should be created', () => {
        const service: ProcessTypeApiService = TestBed.get(ProcessTypeApiService);
        expect(service).toBeTruthy();
    });
});
