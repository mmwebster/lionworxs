Lionworxs.IndexRoute = Ember.Route.extend
  actions:
    willTransition: (transition)->
      Ember.debug('Transitioned')
      @transitionTo('login')
