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

    it('Test old functionality: happy case', () => {
        cy.visit(`${basePath}/people`);
        cy.get("#name,input:nth-of-type(1)").first().type("lukas").blur();
        cy.get("#validation-result-name,span[data-path]:nth-of-type(1)").first().contains(":)")
    });
    it('Test old functionality: not existing', () => {
        cy.visit(`${basePath}/people`);
        cy.get("#name,input:nth-of-type(1)").first().type("neegzistuojantis").blur();
        cy.get("#validation-result-name,span[data-path]:nth-of-type(1)").first().contains(":(")
    });
    it('Test new functionality: happy case: devcollab', () => {
        cy.visit(`${basePath}/people`);
        cy.get("#team,input:nth-of-type(2)").first().type("devcollab").blur();
        cy.get("#validation-result-team,span[data-path]:nth-of-type(2)").first().contains(":)");
        cy.screenshot();
    });
    it('Test new functionality: happy case: barakas', () => {
        cy.visit(`${basePath}/people`);
        cy.get("#team,input:nth-of-type(2)").first().type("barakas").blur();
        cy.get("#validation-result-team,span[data-path]:nth-of-type(2)").first().contains(":)");
        cy.screenshot();
    });
    it('Test new functionality: not existing', () => {
        cy.visit(`${basePath}/people`);
        cy.get("#team,input:nth-of-type(2)").first().type("neegzistuojanti").blur();
        cy.get("#validation-result-team,span[data-path]:nth-of-type(2)").first().contains(":(");
        cy.screenshot();
    });
});
