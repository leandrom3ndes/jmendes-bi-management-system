
export enum TokenVar {
    token_type = 'token_type',
    expires_in = 'expires_in',
    access_token = 'access_token',
    refresh_token = 'refresh_token',
    language_slug = 'language_slug',
}

export class Token {

    constructor(token_type: string, expires_in: string, access_token: string, refresh_token: string, language_slug: string) {
        this.token_type = token_type;
        this.expires_in = expires_in;
        this.access_token = access_token;
        this.refresh_token = refresh_token;
        this.language_slug = language_slug;
        this.setTokenConstruct();
    }
    token_type: string;
    expires_in: string;
    access_token: string;
    refresh_token: string;
    language_slug: string;

    static getTokenLanguage(): string {
      return localStorage.getItem(TokenVar.language_slug);
    }

    public setTokenConstruct() {
        this.setToken(this.access_token);
        this.setTokenType(this.token_type);
        this.setTokenRefresh(this.refresh_token);
        this.setTokenLanguage(this.language_slug);
    }

    getTokenType(): string {
        return localStorage.getItem(TokenVar.token_type);
    }

    getTokenRefresh(): string {
        return localStorage.getItem(TokenVar.refresh_token);
    }

    getToken(): string {
        return localStorage.getItem(TokenVar.access_token);
    }

    setToken(token: string) {
        localStorage.setItem(TokenVar.access_token, token);
    }

    setTokenType(tokenType: string) {
        localStorage.setItem(TokenVar.token_type, tokenType);
    }

    setTokenRefresh(tokenRefresh: string) {
        localStorage.setItem(TokenVar.refresh_token, tokenRefresh);
    }

    setTokenLanguage(tokenLanguage: string) {
        localStorage.setItem(TokenVar.language_slug, tokenLanguage);
    }

}
