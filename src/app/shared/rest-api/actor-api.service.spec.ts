import {TestBed} from '@angular/core/testing';

import {ActorApiService} from './actor-api.service';

describe('ActorApiService', () => {
    beforeEach(() => TestBed.configureTestingModule({}));

    it('should be created', () => {
        const service: ActorApiService = TestBed.get(ActorApiService);
        expect(service).toBeTruthy();
    });
});
