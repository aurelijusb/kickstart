// const basePath = Cypress.env('BASE_URL') ? Cypress.env('BASE_URL') : 'https://hw1.nfq2019.online';
//FIXME: use container tests
const basePath = 'https://hw1.nfq2019.online';

const d = async (message) => {
    console.info('D', message);
    await cy.ciDebug(message);
};
const dd = async (message) => {
    console.log('DD', message);
    await cy.ciLog(message);
};

describe('First homework', function() {
    it('Have students block', () => {
        d(`Testing Students block - simple`);
        d(`Visiting: ${basePath}`);
        cy.visit(basePath);

        d(`Comparing Studentai block`);
        cy.contains("Studentai")
            .parent()
            .children('.list-group-item:not(.list-group-item-info)')
            .then(data => data.map((index, element) => element.innerText).get())
            .then(students => {
                cy.wrap(students).each(student => dd(`Student: ${student}`));
            }).then( students => {
                assert.equal(students.length, 46, "Expected 46 elements of students");
            }).then( students => {
                cy.wrap(students).each(e => {
                    expect(e).contain("Mentorius");
                })
            });
    });
    it('Have correct students-mentor data', () => {
        d(`Testing Students block - data`);
        cy.visit(basePath);

        cy.contains("Studentai")
            .parent()
            .children('.list-group-item:not(.list-group-item-info)')
            .first()
            .contains("Tadas")
            .parent()
            .contains("Mantas")
    });
});
