const basePath = Cypress.env('BASE_URL') ? Cypress.env('BASE_URL') : 'http://127.0.0.1:8000';

const d = async (message) => {
    console.info('D', message);
    await cy.ciDebug(message);
};
const dd = async (message) => {
    console.log('DD', message);
    await cy.ciLog(message);
};

describe('Secodn homework', function() {
    it('Whole page: Homepage', () => {
        cy.visit(basePath);
        cy.screenshot();
    });
    it('Whole page: People', () => {
        cy.visit(`${basePath}/people`);
        cy.screenshot();
    });
});
