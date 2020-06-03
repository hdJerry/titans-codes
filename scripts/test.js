
  let details = {
    fname: "Jerry Hogan",
    id: "HNG-01701",
    language: "JavaScript"
  }

  const intro = (datas) =>{
        let { fname, id, language } = datas;

        let introduction = `Hello World, this is [${fname}] with HNGi7 ID [${id}] using [${language}] for stage 2 task`;
        // console.log('\n');
        // console.log(introduction);
        // console.log('\n');

        return introduction;
    }

  console.log(intro(details));
