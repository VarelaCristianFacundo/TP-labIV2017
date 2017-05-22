import { AuthPage } from './app.po';

describe('auth App', () => {
  let page: AuthPage;

  beforeEach(() => {
    page = new AuthPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
