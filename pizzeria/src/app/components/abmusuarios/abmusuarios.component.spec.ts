import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AbmusuariosComponent } from './abmusuarios.component';

describe('AbmusuariosComponent', () => {
  let component: AbmusuariosComponent;
  let fixture: ComponentFixture<AbmusuariosComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AbmusuariosComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AbmusuariosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
