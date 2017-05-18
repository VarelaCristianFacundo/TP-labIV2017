import { PizzeriaPage } from './app.po';

describe('pizzeria App', () => {
  let page: PizzeriaPage;

  beforeEach(() => {
    page = new PizzeriaPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
