# http://emberjs.com/guides/models/#toc_store
# http://emberjs.com/guides/models/pushing-records-into-the-store/

Lionworxs.Store = DS.Store.extend({

})

# Override the default adapter with the `DS.ActiveModelAdapter` which
# is built to work nicely with the ActiveModel::Serializers gem.
# Lionworxs.ApplicationAdapter = DS.ActiveModelAdapter.extend({
#
# })

Lionworxs.ApplicationAdapter = DS.FixtureAdapter
