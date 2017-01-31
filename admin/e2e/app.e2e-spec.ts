import { TopditopAdminPage } from './app.po';

describe('topditop-admin App', function() {
  let page: TopditopAdminPage;

  beforeEach(() => {
    page = new TopditopAdminPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
