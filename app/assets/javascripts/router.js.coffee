# For more information see: http://emberjs.com/guides/routing/

Lionworxs.Router.map ()->
  @route('about')
  @resource('news')
  @route('contact')
  @route('login')
  @route('register')
  @resource('students')
  @resource('parents')
  @resource('teachers')
  @resource('administrators')
