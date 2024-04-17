//Test para iniciar sesión como cliente
describe('Cliente', () => {

   beforeEach(() => {
      cy.visit('http://localhost/Proyectos/ProyectoGenesisNails2/')
   })

  it('Visitar Pagina Web', () => {
    cy.contains('Genesis Nails')
  })


  it('Iniciar Sesion', () => {
   cy.contains('Ingresar').click()
   cy.get('[placeholder="Nombre de usuario"]').type('cliente')
   cy.get('[placeholder="Password"]').type('cliente')
   cy.get('#login-btn').click()
   cy.contains('Si, realizar').click()
   cy.wait(3000)
   cy.contains('Aceptar').click()
   cy.contains('Principal')
  })
})