const basePath = Cypress.env('BASE_URL') ? Cypress.env('BASE_URL') : 'http://127.0.0.1:8000';

const d = async (message) => {
    console.info('D', message);
    await cy.ciDebug(message);
};
const dd = async (message) => {
    console.log('DD', message);
    await cy.ciLog(message);
};

describe('Second homework', function() {
    it('Whole page: Homepage', () => {
        cy.visit(basePath);
        cy.screenshot();
    });
    it('Whole page: People', () => {
        cy.visit(`${basePath}/people`);
        cy.screenshot();
    });

    it('Test old functionality: happy case', () => {
        cy.visit(`${basePath}/people`);
        cy.get("input").first().type("lukas").blur(); // for #name
        cy.get("span[data-path]").first().contains(":)") // for #validation-result-name
    });
    it('Test old functionality: not existing', () => {
        cy.visit(`${basePath}/people`);
        cy.get("input").first().type("neegzistuojantis").blur(); // for #name
        cy.get("span[data-path]").first().contains(":(") // for #validation-result-name
    });
    it('Test new functionality: happy case: devcollab', () => {
        cy.visit(`${basePath}/people`);
        cy.get("input").last().type("devcollab").blur(); // for #team
        cy.get("span[data-path]").last().contains(":)"); // for #validation-result-team
        cy.screenshot();
    });
    it('Test new functionality: happy case: barakas', () => {
        cy.visit(`${basePath}/people`);
        cy.get("input").last().type("barakas").blur(); // for #team
        cy.get("span[data-path]").last().contains(":)"); // for #validation-result-team
        cy.screenshot();
    });
    it('Test new functionality: not existing', () => {
        cy.visit(`${basePath}/people`);
        cy.get("input").last().type("neegzistuojanti").blur(); // for #team
        cy.get("span[data-path]").last().contains(":("); // for #validation-result-team
        cy.screenshot();
    });
});
