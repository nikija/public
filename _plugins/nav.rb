Jekyll::Hooks.register :site, :pre_render do |site, payload|
  payload["nav"] = []

  site.pages.each do |val|
    if val.url.gsub(/\A\//, "").split("/").size.between?(0, 1)
      payload["nav"] << Drops::NavItem.new(val, payload)
    end
  end
end
