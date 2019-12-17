const basePath = Cypress.env('BASE_URL') ? Cypress.env('BASE_URL') : 'https://hw1.nfq2019.online';

const d = async (message) => {
    console.info('D', message);
    await cy.ciDebug(message);
};
const dd = async (message) => {
    console.log('DD', message);
    await cy.ciLog(message);
};

describe('First homework', function() {
    it('Whole page', () => {
        cy.visit(basePath);
        cy.screenshot();
    });
});
