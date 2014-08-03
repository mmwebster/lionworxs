Lionworxs.NavigationController = Ember.Controller.extend
  needs: 'application'
  loggedIn: Ember.computed.alias('controllers.application.loggedIn')

  partialLink: (->
    if @controllerFor('application').get('loggedIn')
      "_" + @controllerFor('application').get('userType') + "_navigation"
    else
      false
  ).property('loggedIn')

  actions:
    logOut: ->
      logout = confirm("Are you sure you would like to logout?")
      if logout
        @controllerFor('application').logOut()
