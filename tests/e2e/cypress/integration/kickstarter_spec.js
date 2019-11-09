const basePath = Cypress.env('BASE_URL') ? Cypress.env('BASE_URL') : 'http://127.0.0.1:8000';

describe('Kickstarter project', function() {
    it('Shows NFQ Akademija on homepage', function() {
        cy.visit(basePath);
        cy.contains("NFQ Akademija");
        cy.screenshot()
    })
});
