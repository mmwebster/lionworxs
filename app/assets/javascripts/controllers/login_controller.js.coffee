Lionworxs.LoginController = Ember.ObjectController.extend
  user_types: [
    {hr: 'Select', cr: 'select'},
    {hr: 'Student', cr: 'students'},
    {hr: 'Parent', cr: 'parents'},
    {hr: 'Teacher', cr: 'teachers'},
    {hr: 'Administrator', cr: 'administrators'}
  ]
  selected_type: 'select'

  actions:
    login: ->
      user_type = @get('selected_type')
      if user_type isnt 'select'
        Ember.debug 'Logging in ' + user_type
        @controllerFor('application').logIn(user_type)
      else
        alert('You must select a user type.')
